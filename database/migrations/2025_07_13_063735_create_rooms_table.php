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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('room_number');
            $table->enum('room_type', ['single', 'double', 'triple', 'quad', 'studio', 'suite'])->default('single');
            $table->integer('floor_number')->default(1);
            $table->decimal('size_sqm', 8, 2)->nullable();
            $table->integer('capacity')->default(1);
            $table->decimal('price_per_month', 10, 2);
            $table->decimal('security_deposit', 10, 2)->default(0);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_furnished')->default(false);
            $table->boolean('has_private_bathroom')->default(false);
            $table->boolean('has_balcony')->default(false);
            $table->boolean('has_air_conditioning')->default(false);
            $table->boolean('has_heating')->default(false);
            $table->text('description')->nullable();
            $table->json('amenities')->nullable();
            $table->enum('maintenance_status', ['excellent', 'good', 'fair', 'under_maintenance'])->default('good');
            $table->date('last_inspection_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['property_id', 'room_number']);
            $table->index('is_available');
            $table->index('room_type');
            $table->index('price_per_month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
