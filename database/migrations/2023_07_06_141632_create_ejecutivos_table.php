<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ejecutivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('rut')->unique();
            $table->integer('agencia_id');
            $table->integer('cargo_id');
            $table->enum('estado', ['V', 'N']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejecutivos');
    }
};
