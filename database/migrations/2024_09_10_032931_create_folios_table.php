<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoliosTable extends Migration
{
    public function up()
    {
        Schema::create('folios', function (Blueprint $table) {
            $table->id();
            $table->string('numero_folio')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('folios');
    }
}