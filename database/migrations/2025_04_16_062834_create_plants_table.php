<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantsTable extends Migration
{
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();                        // plant ID (PK)
            $table->string('plant_name');       // Plant Name
            $table->string('location');         // Location
            $table->string('growth_stage');     // Growth Stage
            $table->date('planting_date');      // Planting Date
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plants');
    }
}