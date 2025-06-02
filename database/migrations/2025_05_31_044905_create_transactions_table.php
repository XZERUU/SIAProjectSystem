<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('sensor_logs', function (Blueprint $table) {
            $table->id();                        // log ID (PK)
            $table->unsignedBigInteger('sensor_id');  // FK to sensors
            $table->timestamp('logged_at');      // Date & Time
            $table->string('status');            // Status
            $table->timestamps();

            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sensor_logs');
    }
}