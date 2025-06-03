<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = [
        'custom_id',
        'sensor_type',
        'temperature',
        'plant_id',
        'water_level'
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function logs()
    {
        return $this->hasMany(SensorLog::class, 'sensor_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}