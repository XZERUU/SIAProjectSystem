<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sensor_id',
        'logged_at',
        'status',
    ];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

    /**
     * A transaction belongs to a sensor.
     */
    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }

    /**
     * Optional: Format status nicely (e.g., capitalize first letter)
     */
    public function getFormattedStatusAttribute()
    {
        return ucfirst($this->status);
    }

    /**
     * Use default timestamps (created_at, updated_at)
     */
    public $timestamps = true;
}