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
            $table->string('addb');
            $table->string('addt');
            $table->string('addp');
            $table->string('gender');
            $table->date('bdate');
            $table->string('status');
            $table->string('father');
            $table->string('mother');
            $table->string('foccup');
            $table->string('moccup');
            $table->string('addparents');
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
