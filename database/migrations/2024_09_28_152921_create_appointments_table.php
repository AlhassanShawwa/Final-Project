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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->onDelete('cascade');
            $table->foreignId('group_id')->nullable()->onDelete('cascade');
            $table->enum('service_type', ['single', 'group']);
            $table->date('date');
            $table->text('excuse')->nullable();
            $table->enum('status', ['scheduled', 'hanging', 'completed', 'cancelled'])->default('hanging');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
