<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsCollection extends Migration
{
    public function up()
    {
        Schema::connection('mongodb')->create('students', function (Blueprint $collection) {
            $collection->index('name');
            $collection->embedsMany('subjects');
        });
    }

    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('students');
    }
}
