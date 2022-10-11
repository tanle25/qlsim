<?php

use App\Models\SimNetwork;
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
        Schema::table('sim_cards', function (Blueprint $table) {
            //
            $table->dropColumn('network');
            $table->foreignIdFor(SimNetwork::class)->after('iccid')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sim_cards', function (Blueprint $table) {
            //
            $table->string('network')->nullable();
            $table->dropConstrainedForeignIdFor(SimNetwork::class);
        });
    }
};
