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
        Schema::create('property_inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('inspector_staff_id')->constrained('users')->onDelete('cascade');
            $table->enum('inspection_type', ['routine', 'check_in', 'check_out', 'maintenance']);
            $table->date('inspection_date');
            $table->enum('overall_condition', ['excellent', 'good', 'fair', 'poor']);
            $table->text('notes')->nullable();
            $table->json('issues_found')->nullable();
            $table->json('photos')->nullable();
            $table->boolean('follow_up_required')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_inspections');
    }
};
