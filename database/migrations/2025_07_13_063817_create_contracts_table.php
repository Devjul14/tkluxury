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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('contract_number')->unique();
            $table->foreignId('contract_template_id')->constrained()->onDelete('cascade');
            $table->json('generated_content');
            $table->string('file_path')->nullable();
            $table->enum('status', ['draft', 'sent', 'signed', 'active', 'expired', 'terminated'])->default('draft');
            $table->timestamp('signed_by_student_at')->nullable();
            $table->foreignId('signed_by_staff_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('staff_signature_date')->nullable();
            $table->text('termination_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
