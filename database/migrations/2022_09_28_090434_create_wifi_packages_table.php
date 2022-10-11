<?php

use App\Models\WifiNetwork;
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
        Schema::create('wifi_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(WifiNetwork::class)->constrained()->cascadeOnDelete();
            $table->integer('number_of_month');
            $table->integer('price');
            $table->integer('fee');
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
        Schema::dropIfExists('wifi_packages');
    }
};
