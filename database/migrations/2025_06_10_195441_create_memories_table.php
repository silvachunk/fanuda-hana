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
    Schema::create('memories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('fan_id')->constrained()->onDelete('cascade');
        $table->enum('type', ['flirt', 'compliment', 'secret', 'trigger']);
        $table->text('content');
        $table->string('mood')->nullable(); // e.g., excited, coy, playful
        $table->timestamp('remembered_at')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memories');
    }
};
