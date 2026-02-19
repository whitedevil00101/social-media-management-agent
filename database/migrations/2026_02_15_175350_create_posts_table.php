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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->cascadeOnDelete();

            $table->string('instagram_post_id')->unique();
            $table->text('caption')->nullable();

            $table->string('media_type')->nullable();
            $table->text('media_url')->nullable();

            $table->integer('likes')->default(0);
            $table->integer('comments')->default(0);

            $table->timestamp('posted_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
