<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('bank_name')->nullable()->after('vendor_longitude');
            $table->string('bank_ac')->nullable()->after('bank_name');
            $table->string('bank_qr')->nullable()->after('bank_ac');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_ac');
            $table->dropColumn('bank_qr');
        });
    }
};
