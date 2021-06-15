<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempStudEnrolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_stud_enrols', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('online_user_id')->unsigned();
            $table->integer('sem_code')->unsigned();
            $table->string('en_status');
            $table->integer('course')->unsigned();
            $table->string('year',2);
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
        Schema::dropIfExists('temp_stud_enrols');
    }
}
