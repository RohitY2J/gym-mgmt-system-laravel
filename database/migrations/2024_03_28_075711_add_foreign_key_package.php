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
        Schema::table('membership_package_category', function (Blueprint $table) {
            //$table->unsignedBigInteger('categori_id');

            $table->foreignId('category_id')
            ->nullable()->constrained('categories')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membership_package_category', function (Blueprint $table) {
            $table->dropForeign('membership_package_category_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
};
