<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Sensor;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $plants = Plant::all();
        $sensors = Sensor::all();
        $transactions = Transaction::all();

        $totalPlants = $plants->count();
        $totalSensors = $sensors->count();
        $totalTransactions = $transactions->count();

        return view('dashboard', compact(
            'plants',
            'sensors',
            'transactions',
            'totalPlants',
            'totalSensors',
            'totalTransactions'
        ));
    }
}