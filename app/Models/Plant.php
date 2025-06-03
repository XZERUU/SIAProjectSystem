<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = ['custom_id', 'name', 'plant_name', 'location', 'growth_stage', 'planting_date'];

    protected $casts = [
        'planting_date' => 'date',
    ];

    public function sensors()
    {
        return $this->hasMany(Sensor::class);
    }

    public function getLatestTemperatureAttribute()
    {
        $latestSensor = $this->sensors()->orderBy('created_at', 'desc')->first();
        return $latestSensor
            ? number_format($latestSensor->temperature, 2)
            : null;
    }
}