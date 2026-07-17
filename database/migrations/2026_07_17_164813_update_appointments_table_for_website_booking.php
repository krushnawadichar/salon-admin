<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {

            $table->unsignedBigInteger('employee_id')->nullable()->change();

            $table->date('appointment_date')->nullable()->change();

            $table->time('start_time')->nullable()->change();

            $table->time('end_time')->nullable()->change();

            $table->decimal('total_amount',10,2)->default(0)->change();

            $table->decimal('discount',10,2)->default(0)->change();

            $table->decimal('final_amount',10,2)->default(0)->change();

            $table->enum('payment_status',['pending','partial','paid'])
                    ->default('pending')
                    ->change();

            $table->enum('appointment_status',[
                'scheduled',
                'confirmed',
                'in_progress',
                'completed',
                'cancelled',
                'no_show'
            ])->default('scheduled')->change();

        });
    }

    public function down(): void
    {
        //
    }
};