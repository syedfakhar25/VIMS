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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('dep_name');
            $table->string('focal_person');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('short_name');
            $table->string('phone');
            $table->tinyInteger('is_main_dep');

            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('departments')
                ->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
