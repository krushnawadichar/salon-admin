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
       Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('employee_id')->unique();
            $table->enum('employment_type', ['salary', 'commission', 'both'])->default('salary');
            $table->decimal('salary_amount', 10, 2)->nullable();
            $table->decimal('commission_percentage', 5, 2)->nullable();
            $table->date('joining_date');
            $table->string('qualification')->nullable();
            $table->integer('experience_years')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
