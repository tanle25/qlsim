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
        Schema::table('pakages', function (Blueprint $table) {
            //
            $table->dropConstrainedForeignIdFor(Partner::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pakages', function (Blueprint $table) {
            //
            $table->foreignIdFor(Partner::class)->after('name')->nullable()->constrained()->cascadeOnDelete();
        });
    }
};
