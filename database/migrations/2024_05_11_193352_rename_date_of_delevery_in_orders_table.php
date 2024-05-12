<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            DB::statement('ALTER TABLE orders CHANGE `date of delevery` date_of_delevery VARCHAR(255)');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            DB::statement('ALTER TABLE orders CHANGE date_of_delevery `date of delevery` VARCHAR(255)');
  
        });
    }
};
