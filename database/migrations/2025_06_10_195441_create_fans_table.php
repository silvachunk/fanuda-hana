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
    Schema::create('fans', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable(); // fan's name
        $table->string('language')->default('en');
        $table->date('birthday')->nullable();
        $table->unsignedTinyInteger('trust_score')->default(1); // 0-10 scale
        $table->unsignedBigInteger('persona_id')->nullable(); // links to AI persona
        $table->timestamp('last_seen')->nullable();
        $table->string('preferred_name')->nullable(); // e.g., "babe"
        $table->string('relationship_stage')->default('new'); // e.g., new, flirty, emotional
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fans');
    }
};
