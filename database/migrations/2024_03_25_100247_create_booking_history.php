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
        Schema::create('booking_history', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('package_category');

            // Add foreign key constraint
            $table->foreign('user')
                  ->references('id')->on('users')
                  ->onDelete('restrict'); // or 'cascade', 'set null', etc.

            // Add foreign key constraint
            $table->foreign('package_category')
            ->references('id')->on('membership_package_category')
            ->onDelete('restrict'); // or 'cascade', 'set null', etc.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_history');
    }
};
