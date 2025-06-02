@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Plant Details</h5>
                <div>
                    <a href="{{ route('plants.edit', $plant->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <a href="{{ route('plants.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <h6>Basic Information</h6>
                        <hr>
                        <p><strong>Name:</strong> {{ $plant->name }}</p>
                        <p><strong>Scientific Name:</strong> {{ $plant->scientific_name ?? 'N/A' }}</p>
                        <p><strong>Growth Stage:</strong> 
                            <span class="badge 
                                @if($plant->growth_stage == 'Seedling') bg-info
                                @elseif($plant->growth_stage == 'Vegetative') bg-success
                                @elseif($plant->growth_stage == 'Flowering') bg-warning
                                @else bg-primary @endif">
                                {{ $plant->growth_stage }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <h6>Location & Dates</h6>
                        <hr>
                        <p><strong>Greenhouse Unit:</strong> {{ $plant->greenhouseUnit->name }}</p>
                        <p><strong>Planted On:</strong> {{ $plant->planting_date->format('M d, Y') }}</p>
                        <p><strong>Expected Harvest:</strong> 
                            {{ $plant->expected_harvest_date ? $plant->expected_harvest_date->format('M d, Y') : 'Not specified' }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <h6>Additional Notes</h6>
                <hr>
                <p>{{ $plant->notes ?? 'No additional notes' }}</p>
            </div>
        </div>
    </div>
@endsection