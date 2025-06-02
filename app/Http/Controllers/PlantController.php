<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PlantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $field = $request->input('field', 'plant_name'); // Default search field

        $plants = Plant::when($search, function ($query) use ($search, $field) {
            return $query->where($field, 'like', "%{$search}%");
        })->orderBy('planting_date', 'desc')->paginate(7);

        return view('plants.index', compact('plants', 'search', 'field'));
    }

    public function create()
    {
        $growthStages = ['Seedling', 'Vegetative', 'Budding', 'Flowering', 'Ripening'];

        return view('plants.create', [
            'plant' => null,
            'growthStages' => $growthStages
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'plant_name' => 'required',
            'location' => 'required',
            'growth_stage' => 'required',
            'planting_date' => 'required|date',
        ]);

        Plant::create([
            'plant_name' => $request->input('plant_name'),
            'location' => $request->input('location'),
            'growth_stage' => $request->input('growth_stage'),
            'planting_date' => $request->input('planting_date'),
        ]);

        return redirect()->route('plants.index')->with('success', 'Plant added successfully!');
    }

    public function show(Plant $plant)
    {
        return view('plants.show', compact('plant'));
    }

    public function edit(Plant $plant)
    {
        $growthStages = ['Seedling', 'Vegetative', 'Budding', 'Flowering', 'Ripening'];

        return view('plants.edit', [
            'plant' => $plant,
            'growthStages' => $growthStages
        ]);
    }

    public function update(Request $request, Plant $plant)
    {
        $request->validate([
            'plant_name' => 'required',
            'location' => 'required',
            'growth_stage' => 'required',
            'planting_date' => 'required|date',
        ]);

        $plant->update([
            'plant_name' => $request->input('plant_name'),
            'location' => $request->input('location'),
            'growth_stage' => $request->input('growth_stage'),
            'planting_date' => $request->input('planting_date'),
        ]);

        return redirect()->route('plants.index')->with('success', 'Plant updated successfully!');
    }

    public function destroy(Plant $plant)
    {
        $plant->delete();
        return redirect()->route('plants.index')->with('success', 'Plant deleted successfully.');
    }

    // ✅ PDF EXPORT
    public function exportPDF()
    {
        $plants = Plant::all();
        $pdf = Pdf::loadView('plants.pdf', compact('plants'));
        return $pdf->download('plant_report.pdf');
    }
}