<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Document;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $site = Site::create([
            'nom' =>$request->input('nom'),
            'client_id' =>$request->input('client_id'),
            'email' => $request->input('email'),
            'tel' => $request->input('tel'),
            'adresse' =>$request->input('adresse'),
            'observation'=>$request->input('observation'),
        ]);

        Document::find($request->documentIds)->each->update([
            'documentable_id' => $site->id,
            'documentable_type' => Site::class
        ]);

        return redirect()->route('clients.show',[$request->input('client_id')])->with([
            'success' => 'Site creé avec succès!',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        $_site = Site::with('documents','client')->where('id',$site->id)->first();
        return response()->json([
            'site' => $_site
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Site $site)
    {
        $site->update([
            'nom' =>$request->input('nom'),
            'client_id' =>$request->input('client_id'),
            'email' => $request->input('email'),
            'tel' => $request->input('tel'),
            'adresse' =>$request->input('adresse'),
            'observation'=>$request->input('observation'),
        ]);
        
        Document::find($request->documentIds)->each->update([
            'documentable_id' => $site->id,
            'documentable_type' => Site::class
        ]);

        return redirect()->route('clients.show',[$request->input('client_id')])->with([
            'success' => 'Site mis à jour avec succès!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        $site->delete();
        return redirect()->route('clients.show',[$site->client_id])->with([
            'success' => 'Site supprimé avec succès!',
        ]);
    }
}
