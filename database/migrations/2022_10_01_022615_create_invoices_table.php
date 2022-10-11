<?php

use App\Models\Bill;
use App\Models\Partner;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Partner::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Bill::class)->constrained()->cascadeOnDelete();
            $table->morphs('invoiceable');
            $table->integer('origin_price')->comment('import price');
            $table->integer('lease_price');
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
        Schema::dropIfExists('invoices');
    }
};
