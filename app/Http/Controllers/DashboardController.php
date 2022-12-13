<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){
        $planifié = Intervention::where('status','Planifiée')->count();
        $annulé = Intervention::where('status','Annulée')->count();
        $achevé = Intervention::where('status','Effectuée')->count();
        $clients = Client::all()->count();
        return Inertia::render(('Dashboard'),[
            'planifiée' => $planifié,
            'annulée' => $annulé,
            'achevée' => $achevé,
            'clients' => $clients
        ]);
    }
}
