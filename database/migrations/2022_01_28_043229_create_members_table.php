<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentors_id')->references('id')->on('mentors');
            $table->foreignId('divisions_id')->references('id')->on('divisions');
            $table->time('start');
            $table->time('end');
            $table->string('name');
            $table->string('nikp');
            $table->string('univ');
            $table->string('email');
            $table->longText('description');
            $table->bigInteger('phone');
            $table->string('cv');
            $table->string('internship_letter');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
