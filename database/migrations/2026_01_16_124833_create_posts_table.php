<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('category_id')->constrained();
    $table->foreignId('city_id')->nullable()->constrained(); // Nem todo post é de uma cidade específica
    $table->string('title');
    $table->string('slug')->unique();
    $table->string('eyebrow')->nullable(); // Aquela chamada em cima do título (ex: "EXCLUSIVO")
    $table->text('content');
    $table->string('image')->nullable();
    $table->boolean('is_highlight')->default(false); // Para o post gigante do topo
    $table->integer('views')->default(0);
    $table->timestamp('published_at')->nullable();
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};