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
            $table->string('titulo')->default('Acompanhe a Seleção');
            $table->string('confronto'); // Ex: "Brasil vs França"
            $table->boolean('is_active')->default(false); // O interruptor!
            $table->string('cor_fundo')->default('#E8F5E9'); // Verde leve
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
