<?php

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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->after('password', function($table){
                $table->string('phone')->nullable();
                $table->foreignIdFor(Partner::class)->nullable()->constrained()->cascadeOnDelete();
                $table->integer('status')->default(0);
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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropConstrainedForeignIdFor(Partner::class);
            $table->dropColumn(['status','phone']);
        });
    }
};
