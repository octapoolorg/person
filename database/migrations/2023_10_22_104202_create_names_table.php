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
        Schema::create('names', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('meaning');
            $table->string('gender')->nullable()->index();
            $table->string('pronunciation')->nullable();
            $table->string('popularity')->nullable()->index();
            $table->boolean('is_simple')->default(false)->index();
            $table->boolean('is_active')->default(false)->index();
            $table->boolean('is_popular')->default(false)->index();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('names');
    }
};
