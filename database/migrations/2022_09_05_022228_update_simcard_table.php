<?php

use App\Models\Customer;
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
        Schema::table('sim_cards', function (Blueprint $table) {
            //
            $table->after('network',function($table){
                // $table->foreignIdFor(Partner::class)->nullable()->constrained()->cascadeOnDelete();
                // $table->foreignIdFor(Customer::class)->nullable()->constrained()->cascadeOnDelete();
                $table->integer('origin_price')->nullable();
                $table->integer('lease_price')->nullable();
                $table->integer('status')->default(1);
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
        Schema::table('sim_cards', function (Blueprint $table) {
            //
            // $table->dropConstrainedForeignId('partner_id');
            // $table->dropConstrainedForeignId('customer_id');
            $table->dropColumn(['status','origin_price','lease_price']);
        });
    }
};
