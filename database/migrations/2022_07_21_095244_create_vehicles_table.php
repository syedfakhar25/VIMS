<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('reg_no')->unique();
            $table->string('vms_code')->nullable();
            $table->string('department_id')->nullable();
            $table->string('allotee')->nullable();
            $table->string('maker')->nullable();
            $table->string('body_type')->nullable();
            $table->string('vehicle_type')->unique();
            $table->string('model')->nullable();
            $table->string('engine_power')->nullable();
            $table->string('colour')->nullable();
            $table->string('engine_no')->nullable();
            $table->string('chassis_no')->nullable();
            $table->string('type')->nullable();
            $table->string('allotted_by')->nullable();
            $table->string('purchase_type')->nullable();
            $table->string('meter_reading')->nullable();
            $table->string('fuel_average')->nullable();
            $table->string('prev_reg_no')->nullable();
            $table->string('status')->nullable();
            $table->string('entitle')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
