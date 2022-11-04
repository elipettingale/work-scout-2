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
            $table->integer('min_rate')->nullable();
            $table->integer('max_rate')->nullable();
            $table->integer('length')->nullable();
            $table->boolean('ir35')->nullable();
            $table->boolean('remote')->nullable();
            $table->text('description');
            $table->string('url');
            $table->date('posted_at')->nullable();
            $table->json('raw');

            $table->dateTime('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('results');
    }
}
