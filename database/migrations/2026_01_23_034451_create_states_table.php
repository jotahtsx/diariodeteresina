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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('abbr', 2)->unique(); // PI, MA, CE...
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Adiciona o campo state_id na tabela posts
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('state_id')->nullable()->constrained()->onDelete('set null');
        });
    }
};
