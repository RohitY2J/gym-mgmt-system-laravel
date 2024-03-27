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
        Schema::table('booking_history', function (Blueprint $table) {
            $table->string('title')->default("N/A");
            $table->string('description')->default("N/A");
            $table->boolean('is_payment_complete')->default(false);
            $table->integer('payment_amount')->default(0);
            $table->integer('active_status')->default(0);
            $table->timestamp('starting_date')->nullable();
            $table->timestamp('ending_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_history', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('description');
            $table->dropColumn('is_payment_complete');
            $table->dropColumn('payment_amount');
            $table->dropColumn('active_status');
            $table->dropColumn('starting_date');
            $table->dropColumn('ending_date');
        });
    }
};