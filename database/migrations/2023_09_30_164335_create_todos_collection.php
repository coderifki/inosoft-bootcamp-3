<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;

class CreateTodosCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->create('todos', function (Blueprint $collection) {
            $collection->id();
            $collection->string('title');
            $collection->boolean('completed')->default(false);
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('todos');
    }
}
