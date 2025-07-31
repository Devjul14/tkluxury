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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->nullable(); // misal: "homepage", "seo", "footer"
            $table->string('key'); // misal: "site_title"
            $table->text('value')->nullable(); // bisa plaintext atau JSON
            $table->string('type')->default('text'); // text, textarea, image, json, boolean, select, etc
            $table->unsignedBigInteger('parent_id')->nullable(); // support untuk nested setting
            $table->foreign('parent_id')->references('id')->on('settings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
