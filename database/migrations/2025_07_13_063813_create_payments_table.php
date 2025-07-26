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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->enum('payment_type', ['security_deposit', 'monthly_rent', 'utility', 'late_fee', 'damage_fee']);
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['credit_card', 'bank_transfer', 'cash']);
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->string('transaction_id')->nullable();
            $table->date('payment_date')->nullable();
            $table->date('due_date');
            $table->string('stripe_payment_intent_id')->nullable();
            $table->boolean('late_fee_applied')->default(false);
            $table->text('notes')->nullable();
            $table->foreignId('processed_by_staff_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
