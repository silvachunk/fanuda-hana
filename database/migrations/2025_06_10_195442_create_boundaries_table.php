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
    Schema::create('boundaries', function (Blueprint $table) {
        $table->id();
        $table->foreignId('fan_id')->constrained()->onDelete('cascade');
        $table->enum('violation', ['cam_request', 'voice_request', 'aggression', 'spam', 'image_upload']);
        $table->text('message')->nullable(); // fan message that triggered
        $table->boolean('escalated')->default(false);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boundaries');
    }
};
