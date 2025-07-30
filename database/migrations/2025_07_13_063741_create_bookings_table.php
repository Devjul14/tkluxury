<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->string('booking_reference')->unique();
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('duration_months');
            $table->decimal('monthly_rent', 10, 2);
            $table->decimal('security_deposit', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'active', 'completed', 'cancelled'])->default('pending');
            $table->date('booking_date');
            $table->text('special_requests')->nullable();
            $table->string('assigned_room_number')->nullable();
            $table->date('key_handover_date')->nullable();
            $table->text('check_in_notes')->nullable();
            $table->text('check_out_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
