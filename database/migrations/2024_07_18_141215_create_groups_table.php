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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('total_before_discount', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('total_after_discount', 8, 2);
            $table->string('tax_rate');
            $table->decimal('total_with_tax', 8, 2);
            $table->foreignId('department_id')->onDelete('cascade');
            $table->enum('status', ['active', 'disable'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};