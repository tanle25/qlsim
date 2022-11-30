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
        Schema::table('sim_networks', function (Blueprint $table) {
            //
            $table->after('name', function($table){
                $table->integer('price');
                $table->integer('lease_price');
                $table->integer('duration');
            });

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sim_networks', function (Blueprint $table) {
            //
            $table->dropColumn(['price','lease_price','duration']);
        });
    }
};
