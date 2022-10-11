<?php

use App\Models\Partner;
use App\Models\SimCard;
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
        Schema::create('sim_owners', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Partner::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SimCard::class)->constrained()->cascadeOnDelete();
            $table->integer('origin_price')->nullable();
            $table->integer('lease_price')->nullable();
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
        Schema::dropIfExists('sim_owners');
    }
};
