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
        Schema::create('clientreports', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->string('title');
            $table->string('summary');
            $table->string('type')->default('clientreport');
            $table->text('pdffile');
            $table->string('client_name');
            $table->string('project_name');
            $table->timestamps();

            $table->primary('id');
            
            $table
            ->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientreports');
    }
};