<?php

// database/migrations/xxxx_xx_xx_create_invitados_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitadosTable extends Migration
{
    public function up()
    {
        Schema::create('invitados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('estatus', ['confirmado', 'no_confirmado']);
            $table->enum('tipo', ['novio', 'novia']);
            $table->boolean('principal')->default(false);
            $table->foreignId('folio_id')->constrained('folios');
            $table->timestamps();
            //$table->unique(['folio_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('invitados');
    }
}