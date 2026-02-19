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
        Schema::create('profile_insights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->unique()->constrained()->cascadeOnDelete();

            $table->json('insight_json');
            $table->integer('version')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_insights');
    }
};
