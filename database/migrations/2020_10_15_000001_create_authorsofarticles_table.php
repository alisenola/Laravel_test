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
        Schema::create('authorsofarticles', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('article_id');
            $table->uuid('author_id');
            $table->timestamps();

            $table->primary('id');
            
            $table
                ->foreign('article_id')
                ->references('id')
                ->on('articles')
                ->onDelete('CASCADE');
            $table
                ->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authorsofarticles');
    }
};