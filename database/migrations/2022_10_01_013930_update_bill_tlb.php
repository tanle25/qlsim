<?php

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
        Schema::table('bills', function (Blueprint $table) {
            //
            $table->dropConstrainedForeignIdFor(SimCard::class);
            $table->after('id',function($table){
                $table->morphs('modelable');
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
        Schema::table('bills', function (Blueprint $table) {
            //
            $table->foreignIdFor(SimCard::class)->constrained()->cascadeOnDelete();
            $table->dropMorphs('modelable');
        });
    }
};
