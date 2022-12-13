<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Document;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients= Client::with('sites')->paginate(5);
        return Inertia::render('Client/Index' , [
            'clients' => $clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Client/Create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = Client::create([
            'nom' =>$request->input('nom'),
            'prenom' =>$request->input('prenom'),
            'ntva' =>$request->input('ntva'),
            'email' => $request->input('email'),
            'emailSs' => $request->input('emailSs'),
            'emailFact'=>$request->input('emailFact'),
            'adresse'=>$request->input('adresse'),
            'adresseSs'=>$request->input('adresseSs'),
            'tele'=>$request->input('tele'),
            'observation'=>$request->input('observation'),
            'siteInternet'=>$request->input('siteInternet'),]
        );

        Document::find($request->documentIds)->each->update([
            'documentable_id' => $client->id,
            'documentable_type' => Client::class
        ]);

        foreach($request->input("sites") as $site)
        {
            $sitecreated = Site::create([
                'nom' =>$site['nom'],
                'client_id' =>$client['id'],
                'email' => $site['email'],
                'tel' => $site['tel'],
                'adresse' =>$site['adresse'],
                'observation'=>$site['observation'],
            ]);
            Document::find($site['documentIds'])->each->update([
                'documentable_id' => $sitecreated->id,
                'documentable_type' => Site::class
            ]);
        }

        return redirect()->route('clients.index')->with([
            'success' => 'Client creé avec succès!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $_client = Client::with('sites','documents')->where('id',$client->id)->first();
        return Inertia::render('Client/Show' ,[
            'client' => $_client,
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        
        $_client = Client::with('sites','documents')->where('id',$client->id)->first();
        return Inertia::render('Client/Edit' ,[
            'client' => $_client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        
        $client->update([
                'nom' =>$request->input('nom'),
                'prenom' =>$request->input('prenom'),
                'ntva' =>$request->input('ntva'),
                'email' => $request->input('email'),
                'emailSs' => $request->input('emailSs'),
                'emailFact'=>$request->input('emailFact'),
                'adresse'=>$request->input('adresse'),
                'adresseSs'=>$request->input('adresseSs'),
                'tele'=>$request->input('tele'),
                'observation'=>$request->input('observation'),
                'siteInternet'=>$request->input('siteInternet'),]
        );

        Document::find($request->documentIds)->each->update([
            'documentable_id' => $client->id,
            'documentable_type' => Client::class
        ]);

        return redirect()->route('clients.index')->with([
            'success' => 'Client mis à jour avec succès!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with([
            'success' => 'Client supprimé avec succès!',
        ]);
    }
}
