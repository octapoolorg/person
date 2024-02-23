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
        Schema::create('name_similar', function (Blueprint $table) {
            $table->foreignId('name_id')->constrained('names');
            $table->foreignId('similar_name_id')->constrained('names');
            $table->primary(['name_id', 'similar_name_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('similar_names');
    }
};
