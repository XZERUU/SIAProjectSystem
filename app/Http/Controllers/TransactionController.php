<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    /**
     * Show a paginated list of all transactions (global index).
     */
    public function globalIndex(Request $request)
    {
        $search = $request->input('search');
        $sensorFilter = $request->input('sensor');

        $query = Transaction::with('sensor')->orderBy('logged_at', 'desc');

        if ($search) {
            $query->where('status', 'like', "%{$search}%")
                ->orWhereHas('sensor', function ($q) use ($search) {
                    $q->where('sensor_type', 'like', "%{$search}%");
                });
        }

        if ($sensorFilter) {
            $query->where('sensor_id', $sensorFilter);
        }

        $transactions = $query->paginate(10);
        $sensors = Sensor::all();
        $firstSensorId = $sensors->first()?->id;

        return view('transactions.index', compact('transactions', 'sensors', 'search', 'sensorFilter', 'firstSensorId'));
    }

    /**
     * List transactions under a specific sensor.
     */
    public function index(Sensor $sensor)
    {
        $transactions = $sensor->transactions()->latest('logged_at')->paginate(10);
        $sensors = Sensor::all();
        $search = null;
        $sensorFilter = $sensor->id;
        $firstSensorId = $sensor->id;

        return view('transactions.index', compact('transactions', 'sensors', 'search', 'sensorFilter', 'firstSensorId'));
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
            ->route('sensors.transactions.index', ['sensor' => $sensor->id])
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
            ->route('sensors.transactions.index', ['sensor' => $sensor->id])
            ->with('success', 'Transaction updated.');
    }

    public function destroy(Sensor $sensor, Transaction $transaction)
    {
        $transaction->delete();

        return redirect()
            ->route('sensors.transactions.index', ['sensor' => $sensor->id])
            ->with('success', 'Transaction removed.');
    }

    /**
     * Export transactions as PDF.
     */
    public function exportPDF()
    {
        $transactions = Transaction::with('sensor')->get();
        $pdf = Pdf::loadView('transactions.pdf', compact('transactions'));

        return $pdf->download('transactions_report.pdf');
    }
}