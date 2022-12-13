<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Document;
use App\Models\Intervention;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\Intervention as InterventionResource;
use App\Models\Fournisseur;
use Inertia\Inertia;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interventions = Intervention::with('site')->paginate(5);
        return Inertia::render('Intervention/Index' , [
            'interventions' => $interventions,
        ]);
    }
    public function interventionstojson()
    {

            $interventions = Intervention::all();
            return response()-> json(InterventionResource::collection($interventions));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $fournisseurs = Fournisseur::all();
        return Inertia::render('Intervention/Create',[
            'fournisseurs' => $fournisseurs,
            'sites' =>  $sites = Site::all(),
            'message',
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $intervention = Intervention::create([
            'titre'=>$request->input('titre'),
            'site_id'=>$request->input('site_id'),
            'type'=> $request->input('type'),
            'desc'=>$request->input('desc'),
            'urgence'=>$request->input('urgence'),
            'dateDb'=>$request->input('dateDb'),
            'dateFn'=>$request->input('dateFn'),
            'etat'=>$request->input('etat'),
            'tempsNes'=>$request->input('tempsNes'),
            'frequence'=>$request->input('frequence'),
        ]);
        $articles = $request->input("articles");

        foreach($articles as $article)
        {
            DB::insert('insert into article_intervention(intervention_id,article_id ,Qt) values (?, ?,?)', [$intervention->id,$article['article_id'], $article['Qt']]);
        }

        Document::find($request->documentIds)->each->update([
            'documentable_id' => $intervention->id,
            'documentable_type' => Intervention::class
        ]);

        return redirect()->route('interventions.index')->with([
            'success' => 'Intervention crée avec succès!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Intervention $intervention)
    {   
        $articles =DB::select('select b.id, a.article_id,a.intervention_id,a.Qt ,b.* from article_intervention  a , articles b  where a.intervention_id = ? AND b.id = a.article_id', [$intervention->id]);
        $intervention = Intervention::with('site','documents')->where('id',$intervention->id)->first();

        return Inertia::render('Intervention/Show' , [
            'intervention' => $intervention,
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Intervention $intervention)
    {
        $articles =DB::select('select b.id, a.article_id,a.intervention_id,a.Qt ,b.* from article_intervention  a , articles b  where a.intervention_id = ? AND b.id = a.article_id', [$intervention->id]);
        $_intervention = Intervention::with('site','documents')->where('id',$intervention->id)->first();
        $sites = Site::all();
        return Inertia::render('Intervention/Edit' , [
            'sites' =>  $sites,
            'intervention' => $_intervention,
            'articles' => $articles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Intervention $intervention)
    {
        $intervention->update([
            'titre' =>$request->input('titre'),
            'site_id' =>$request->input('site_id'),
            'type'=>$request->input('type'),
            'desc'=>$request->input('desc'),
            'urgence'=>$request->input('urgence'),
            'dateDb'=>$request->input('dateDb'),
            'dateFn'=>$request->input('dateFn'),
            'tempsNes'=>$request->input('tempsNes'),
            'frequence'=>$request->input('frequence'),
        ]);

        Document::find($request->documentIds)->each->update([
            'documentable_id' => $intervention->id,
            'documentable_type' => Intervention::class
        ]);

        DB::table('article_intervention')->where('intervention_id', $intervention->id)->delete();
        $articles = $request->input("articles");
        foreach($articles as $article)
        {
            DB::insert('insert into article_intervention(intervention_id,article_id ,Qt) values (?, ?,?)', [$intervention->id,$article['article_id'], $article['Qt']]);
        }
        return redirect()->route('interventions.index')->with([
            'success' => 'Intervention mis à jour avec succès!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Intervention $intervention)
    {
        $intervention->delete();
        return redirect()->route('interventions.index')->with([
            'success' => 'Intervention supprimé avec succès!',
        ]);
    }
}
