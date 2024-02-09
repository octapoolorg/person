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
            $table->text('meaning');
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->boolean('generated')->default(false);
            $table->foreignId('gender_id');
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
