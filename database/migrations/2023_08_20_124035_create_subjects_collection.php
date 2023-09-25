<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsCollection extends Migration
{
    public function up()
    {
        Schema::connection('mongodb')->create('subjects', function (Blueprint $collection) {
            $collection->index('name');
            $collection->embedsMany('exercise_scores');
            $collection->embedsMany('daily_scores');
            $collection->float('midterm_score');
            $collection->float('final_score');
        });
    }

    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('subjects');
    }
}
