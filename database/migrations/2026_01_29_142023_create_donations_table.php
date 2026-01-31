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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            // Link to the user (Donor)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Food Details
            $table->string('food_name');
            $table->text('description')->nullable();
            $table->string('quantity');
            $table->dateTime('expiry_date');

            // Logistics
            $table->string('pickup_location');
            $table->string('place')->after('pickup_location');
            $table->string('image_path')->nullable();

            // Status: pending, assigned, collected, delivered
            $table->string('status')->default('pending');

            // Link to the volunteer (if assigned)
            $table->foreignId('volunteer_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
