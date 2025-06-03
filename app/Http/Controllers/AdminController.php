<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\Sensor;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalPlants' => Plant::count(),
            'totalSensors' => Sensor::count(),
            'totalTransactions' => Transaction::count(),
            'plants' => Plant::all(),
            'sensors' => Sensor::with('plant')->get(),
            'transactions' => Transaction::with('plant')->latest()->take(10)->get(), // limit optional
        ]);
    }
}