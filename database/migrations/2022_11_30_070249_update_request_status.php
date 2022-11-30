<?php

use App\Models\Partner;
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
        Schema::table('request_statuses', function (Blueprint $table) {
            //
            // $table->dropConstrainedForeignIdFor(Partner::class);
            $table->foreignIdFor(User::class)->after('id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_statuses', function (Blueprint $table) {
            //
            $table->foreignIdFor(Partner::class)->nullable()->constrained()->cascadeOnDelete();
            $table->dropConstrainedForeignIdFor(User::class);
        });
    }
};
