<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('country', 100);
            $table->string('city', 100);
            $table->string('country_traveling_to', 100);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->date('date_of_birth');
            $table->string('nationality', 100);
            $table->string('gender', 20);
            $table->string('marital_status', 20);
            $table->string('passport_no', 50);
            $table->string('confirm_passport_no', 50);
            $table->date('passport_issue_date');
            $table->string('passport_issue_place', 100);
            $table->date('passport_expiry_date');
            $table->string('visa_type', 50);
            $table->string('email', 150);
            $table->string('phone', 20);
            $table->string('national_id', 50);
            $table->string('position_applied', 100);
            $table->string('other_position', 100)->nullable();
            $table->boolean('confirm_info')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

