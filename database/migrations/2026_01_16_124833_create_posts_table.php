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
        
        // MUDANÇA AQUI: nullable() e onDelete('set null')
        // Isso impede que as notícias sumam se a categoria for apagada
        $table->foreignId('category_id')
              ->nullable() 
              ->constrained()
              ->onDelete('set null');

        // MUDANÇA AQUI: Se o autor for deletado, as notícias dele devem sumir? 
        // Geralmente usamos 'set null' ou bloqueamos no Controller. 
        // Vou manter cascade se for regra de negócio, mas 'set null' é mais seguro.
        $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); 
        
        $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');
        $table->foreignId('state_id')->nullable()->constrained()->onDelete('set null');
        
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('status')->default('published'); // published, draft, archived
        $table->string('eyebrow')->nullable(); // Aquele chapeu/retranca em cima do titulo
        $table->text('content');
        $table->string('image')->nullable();
        
        $table->boolean('is_highlight')->default(false); 
        $table->boolean('is_featured')->default(false);  
        
        $table->integer('views')->default(0);
        $table->timestamp('published_at')->useCurrent(); // Melhor usar current como default
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};