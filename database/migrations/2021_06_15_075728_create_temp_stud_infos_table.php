<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempStudInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_stud_infos', function (Blueprint $table) {
            $table->id();
            $table->string('lname');
            $table->string('fname');
            $table->string('mname');
            $table->string('addb')->nullable();
            $table->string('addt')->nullable();
            $table->string('addp')->nullable();
            $table->string('gender')->nullable();
            $table->date('bdate')->nullable();
            $table->string('status')->nullable();
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->string('foccup')->nullable();
            $table->string('moccup')->nullable();
            $table->string('addparents')->nullable();
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
        Schema::dropIfExists('temp_stud_infos');
    }
}
