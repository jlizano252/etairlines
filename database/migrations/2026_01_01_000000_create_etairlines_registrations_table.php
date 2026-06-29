<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etairlines_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('school')->nullable();
            $table->string('phone', 30);
            $table->string('email')->nullable();
            $table->string('interest_one')->nullable();
            $table->string('interest_two')->nullable();
            $table->string('coupon_code', 30)->nullable()->unique();
            $table->timestamp('email_sent_at')->nullable();
            $table->timestamps();

            $table->index('phone');
            $table->index('email');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etairlines_registrations');
    }
};
