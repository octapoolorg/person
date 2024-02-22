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
        Schema::create('name_sibling', function (Blueprint $table) {
            $table->id();
            $table->foreignId('name_id')->constrained('names');
            $table->foreignId('sibling_name_id')->constrained('names');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sibling_names');
    }
};
