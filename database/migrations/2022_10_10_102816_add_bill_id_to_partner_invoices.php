<?php

use App\Models\Bill;
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
        Schema::table('partner_invoices', function (Blueprint $table) {
            //
            $table->foreignIdFor(Bill::class)->after('partner_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner_invoices', function (Blueprint $table) {
            //
            $table->dropConstrainedForeignIdFor(Bill::class);
        });
    }
};
