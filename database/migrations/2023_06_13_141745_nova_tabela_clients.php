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
    Schema::create('clients', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('apelido');
        $table->string('time');
        $table->bigInteger('CPF');
        $table->string('hobbie');
        $table->unsignedBigInteger('cidade_id')->nullable();
        $table->foreign('cidade_id')->references('id')->on('cities');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
                Schema::dropIfExists('clients');

    }
};
