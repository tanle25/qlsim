<?php

use App\Models\Pakage;
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
        Schema::create('partner_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Partner::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Pakage::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('partner_packages');
    }
};
