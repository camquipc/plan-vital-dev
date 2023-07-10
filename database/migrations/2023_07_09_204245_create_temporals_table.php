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
        Schema::create('temporals', function (Blueprint $table) {
            $table->id();
            $table->integer('agencia_id');
            $table->integer('cargo_id');
            $table->integer('ejecutivo_id');
            $table->date('fecha');
            $table->string('jefatura', 1);
            $table->string('estado');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporals');
    }
};
