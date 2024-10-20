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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->onDelete('cascade');
            $table->foreignId('doctor_id')->onDelete('cascade');
            $table->foreignId('referred_to_doctor_id')->onDelete('cascade');
            $table->string('reason');
            $table->date('date');
            $table->enum('status', ['pending', 'completed', 'rejected'])->default('pending'); // حالة التحويل
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
