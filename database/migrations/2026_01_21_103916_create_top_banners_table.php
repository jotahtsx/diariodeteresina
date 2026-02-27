<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('top_banners', function (Blueprint $table) {
        $table->id();
        $table->string('titulo')->nullable(); // Ex: "Grande Final", "Paredão"
        $table->string('confronto')->nullable(); // Ex: "Fazenda vs Cidade", "Time A x Time B"
        $table->string('position')->default('header'); // Para o Controller filtrar
        $table->string('cor_fundo')->default('#ff0000');
        $table->boolean('is_active')->default(true);
        $table->string('image_url')->nullable(); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_banners');
    }
};
