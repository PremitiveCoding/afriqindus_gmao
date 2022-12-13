<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Document;
use App\Models\Site;
use App\Models\Intervention;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $num_clients= Client::all()->count();
        $num_interventions=Intervention::all()->count();
        $num_interventions_acheve=Intervention->where("status","achevé")->count();
        $num_interventions_planifie=Intervention->where("status","planifié")->count();
        $num_interventions_annule=Intervention->where("status","annulé")->count();
        dd( $num_clients,$num_interventions);
        return Inertia::render('Dashboard' , [
            'num_clients' => $num_clients,
        ]);
        
        
        
    }

}
