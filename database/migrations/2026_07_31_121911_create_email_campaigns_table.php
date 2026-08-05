<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_campaigns', function (Blueprint $table) {

            $table->id();

            $table->string('type')->default('etairlines_reminder');

            $table->string('subject');

            $table->integer('total')->default(0);

            $table->integer('sent')->default(0);

            $table->integer('failed')->default(0);

            $table->enum('status', [
                'processing',
                'completed',
                'failed'
            ])->default('processing');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_campaigns');
    }
};
