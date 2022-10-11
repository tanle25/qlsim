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
        Schema::table('invoices', function (Blueprint $table) {
            //
            $table->integer('type')->after('lease_price');
        });
        Schema::table('partner_invoices', function (Blueprint $table) {
            //
            $table->integer('type')->after('lease_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            //
            $table->dropColumn('type');
        });
        Schema::table('partner_invoices', function (Blueprint $table) {
            //
            $table->dropColumn('type');
        });
    }
};
