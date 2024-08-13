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
        Schema::create('press_view_likes', function (Blueprint $table) {
            $table->id();
            $table->string('id_travel')->nullable();
            $table->string('id_user_view')->nullable();
            $table->integer('view')->nullable()->default(0);
            $table->string('id_user_like')->nullable();
            $table->integer('like')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('press_view_likes');
    }
};
