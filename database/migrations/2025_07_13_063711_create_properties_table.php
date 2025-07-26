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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->onDelete('cascade');
            $table->string('property_code')->unique();
            $table->string('title');
            $table->text('description');
            $table->enum('property_type', ['apartment', 'room', 'studio', 'house', 'dormitory']);
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->decimal('distance_to_institute', 8, 3)->nullable();
            $table->integer('total_rooms');
            $table->integer('available_rooms');
            $table->decimal('price_per_month', 10, 2);
            $table->decimal('security_deposit', 10, 2);
            $table->boolean('utility_costs_included')->default(false);
            $table->boolean('furnished')->default(false);
            $table->integer('lease_duration_min');
            $table->integer('lease_duration_max');
            $table->date('available_from');
            $table->date('available_until')->nullable();
            $table->boolean('is_active')->default(true);
            $table->enum('maintenance_status', ['excellent', 'good', 'fair', 'under_maintenance'])->default('good');
            $table->text('property_manager_notes')->nullable();
            $table->date('acquisition_date')->nullable();
            $table->decimal('monthly_expenses', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
