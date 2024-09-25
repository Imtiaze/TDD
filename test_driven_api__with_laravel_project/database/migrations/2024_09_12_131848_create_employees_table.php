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
            $table->uuid('uuid');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->bigInteger('department_id');
            $table->string('job_title');
            $table->string('payment_type')->comment('salary or hourly_rate');
            $table->integer('salary')->comment('only if salary type is salary');
            $table->integer('hourly_rate')->comment('only if salary type is hourly_rate');
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
