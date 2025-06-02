<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['sensor_id','logged_at','status'];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}