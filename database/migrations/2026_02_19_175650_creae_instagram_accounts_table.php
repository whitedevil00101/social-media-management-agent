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
        Schema::create('instagram_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->nullable()->constrained()->cascadeOnDelete();

            $table->string('instagram_business_id');
            $table->string('page_id');
            $table->string('username');

            $table->text('access_token');
            $table->timestamp('token_expires_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
