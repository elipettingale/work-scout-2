<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    public function up()
    {
        Schema::create('results', function (Blueprint $table)
        {
            $table->id();
            $table->string('job_site');
            $table->string('reference');
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->string('title');
            $table->string('rate');
            $table->string('length');
            $table->string('ir35');
            $table->string('remote');

            $table->integer('score')->nullable();
            $table->json('data');

            $table->dateTime('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('results');
    }
}
