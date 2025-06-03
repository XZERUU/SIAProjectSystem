<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Sensor;
use App\Models\Transaction;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the user dashboard with lists of plants, sensors, and transactions.
     */
    public function index()
    {
        // Get paginated plants ordered by planting date descending
        $plants = Plant::orderBy('planting_date', 'desc')->paginate(10);

        // Get paginated sensors with their associated plant
        $sensors = Sensor::with('plant')->paginate(10);

        // Get paginated transactions with their associated sensor, ordered by logged_at descending
        $transactions = Transaction::with('sensor')->orderBy('logged_at', 'desc')->paginate(10);

        // Return the user dashboard view with the data
        return view('users.index', compact('plants', 'sensors', 'transactions'));
    }
}