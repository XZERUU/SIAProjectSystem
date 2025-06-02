<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorsTable extends Migration
{
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();                        // sensor ID (PK)
            $table->string('sensor_type');      // Sensor Type
            $table->decimal('temperature', 5, 2);
            $table->unsignedBigInteger('plant_id'); // FK to plants
            $table->decimal('water_level', 8, 2);
            $table->timestamps();

            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sensors');
    }
}