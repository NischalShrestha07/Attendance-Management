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
        Schema::create('staff_record', function (Blueprint $table) {
            $table->id();
            $table->string('staffId');
            $table->date('date');
            $table->string('check_in_time');
            $table->string('check_out_time');
            $table->string('totalWorkingHrs');
            $table->string('attendanceStatus');
            $table->string('note');
            $table->string('leaveType');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_record');
    }
};
