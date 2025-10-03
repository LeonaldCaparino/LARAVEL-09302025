<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->foreignId('company_id')
                  ->nullable()
                  ->constrained('companies')
                  ->nullOnDelete();

            // Job details
            $table->string('title');
            $table->string('location')->nullable();
            $table->string('salary')->nullable();
            $table->text('description');
            $table->string('logo_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};