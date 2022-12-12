<?php

use App\Models\User;
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
        Schema::table('sim_owners', function (Blueprint $table) {
            //
            DB::table('sim_owners')->truncate();
            $table->dropConstrainedForeignIdFor(User::class);
            $table->after('id', function($table){
                $table->morphs('ownerable');
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
        Schema::table('sim_owners', function (Blueprint $table) {
            //
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
        });
    }
};
