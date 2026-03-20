<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE appointments 
        MODIFY appointment_status 
        ENUM('scheduled','confirmed','in_progress','completed','cancelled','no_show') 
        DEFAULT 'scheduled'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE appointments 
        MODIFY appointment_status 
        ENUM('scheduled','completed','cancelled','no_show') 
        DEFAULT 'scheduled'");
    }
};