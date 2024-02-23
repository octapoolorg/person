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
            $table->foreignId('name_id')->constrained('names');
            $table->foreignId('sibling_name_id')->constrained('names');
            $table->primary(['name_id', 'sibling_name_id']);
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
