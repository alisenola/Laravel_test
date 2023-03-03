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
        Schema::create('authorsofclientreports', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('clientreport_id');
            $table->uuid('author_id');
            $table->timestamps();

            $table->primary('id');
            
            $table
                ->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->onDelete('CASCADE');
            $table
                ->foreign('clientreport_id')
                ->references('id')
                ->on('clientreports')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authorsofclientreports');
    }
};