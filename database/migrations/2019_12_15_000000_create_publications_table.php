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
        Schema::create('publications', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->string('title');
            $table->string('summary');
            $table->string('type');
            $table->text('authors');
            $table->text('pdffile');
            $table->longtext('startpage');
            $table->longtext('endpage');
            $table->string('client_name');
            $table->string('project_name');
            $table->text('topics');
            $table->string('numpages');
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
        Schema::dropIfExists('publications');
    }
};