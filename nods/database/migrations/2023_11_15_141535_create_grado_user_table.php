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
        Schema::create('grado_user', function (Blueprint $table) {
            $table->unsignedBigInteger('grado_id');
            $table->unsignedBigInteger('user_id');
            $table->primary(['grado_id','user_id']);

            $table->foreign('grado_id')->references('id')->on('grados')->ondelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')->ondelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grado_user');
    }
};
