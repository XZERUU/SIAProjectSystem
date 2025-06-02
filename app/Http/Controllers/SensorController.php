<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    /**
     * Show a paginated list of all sensors (global index).
     */
    public function globalIndex()
    {
        // Eager-load each sensor’s plant so you can display the plant name in your view
        $sensors = Sensor::with('plant')->paginate(10);
        return view('sensors.globalIndex', compact('sensors'));
    }

    /**
     * Display a paginated list of sensors belonging to a specific plant.
     */
    public function index(Plant $plant)
    {
        $sensors = $plant->sensors()->paginate(10);
        return view('sensors.index', compact('plant', 'sensors'));
    }

    public function create(Plant $plant)
    {
        return view('sensors.create', compact('plant'));
    }

    public function store(Request $request, Plant $plant)
    {
        $validated = $request->validate([
            'sensor_type' => 'required|string|max:255',
            'temperature' => 'required|numeric',
            'water_level' => 'required|numeric',
        ]);

        $plant->sensors()->create($validated);

        return redirect()
            ->route('plants.sensors.index', $plant)
            ->with('success', 'Sensor added.');
    }

    public function show(Plant $plant, Sensor $sensor)
    {
        return view('sensors.show', compact('plant', 'sensor'));
    }

    public function edit(Plant $plant, Sensor $sensor)
    {
        return view('sensors.edit', compact('plant', 'sensor'));
    }

    public function update(Request $request, Plant $plant, Sensor $sensor)
    {
        $validated = $request->validate([
            'sensor_type' => 'required|string|max:255',
            'temperature' => 'required|numeric',
            'water_level' => 'required|numeric',
        ]);

        $sensor->update($validated);

        return redirect()
            ->route('plants.sensors.index', $plant)
            ->with('success', 'Sensor updated.');
    }

    public function destroy(Plant $plant, Sensor $sensor)
    {
        $sensor->delete();

        return redirect()
            ->route('plants.sensors.index', $plant)
            ->with('success', 'Sensor removed.');
    }
}