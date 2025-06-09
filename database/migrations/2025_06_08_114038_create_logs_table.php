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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('action'); // The action performed (e.g., 'create', 'update', 'delete')
            $table->string('model_type'); // The type of model being affected (e.g., 'Item', 'User')
            $table->unsignedBigInteger('model_id')->nullable(); // The ID of the affected model
            $table->json('old_values')->nullable(); // Previous values before the change
            $table->json('new_values')->nullable(); // New values after the change
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->text('description')->nullable(); // Additional description of the event
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
