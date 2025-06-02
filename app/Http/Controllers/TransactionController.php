<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Show a paginated list of all transactions (global index).
     */
    public function globalIndex()
    {
        // Eager-load each transaction’s sensor (and optionally sensor→plant if needed)
        $transactions = Transaction::with('sensor')->orderBy('logged_at', 'desc')->paginate(10);
        return view('transactions.globalIndex', compact('transactions'));
    }

    /**
     * Display a paginated list of transactions for a specific sensor.
     */
    public function index(Sensor $sensor)
    {
        $transactions = $sensor->transactions()
                               ->orderBy('logged_at', 'desc')
                               ->paginate(10);

        return view('transactions.index', compact('sensor', 'transactions'));
    }

    public function create(Sensor $sensor)
    {
        return view('transactions.create', compact('sensor'));
    }

    public function store(Request $request, Sensor $sensor)
    {
        $validated = $request->validate([
            'logged_at' => 'required|date',
            'status'    => 'required|string|max:255',
        ]);

        $sensor->transactions()->create($validated);

        return redirect()
            ->route('sensors.transactions.index', $sensor)
            ->with('success', 'Transaction recorded.');
    }

    public function show(Sensor $sensor, Transaction $transaction)
    {
        return view('transactions.show', compact('sensor', 'transaction'));
    }

    public function edit(Sensor $sensor, Transaction $transaction)
    {
        return view('transactions.edit', compact('sensor', 'transaction'));
    }

    public function update(Request $request, Sensor $sensor, Transaction $transaction)
    {
        $validated = $request->validate([
            'logged_at' => 'required|date',
            'status'    => 'required|string|max:255',
        ]);

        $transaction->update($validated);

        return redirect()
            ->route('sensors.transactions.index', $sensor)
            ->with('success', 'Transaction updated.');
    }

    public function destroy(Sensor $sensor, Transaction $transaction)
    {
        $transaction->delete();

        return redirect()
            ->route('sensors.transactions.index', $sensor)
            ->with('success', 'Transaction removed.');
    }
}