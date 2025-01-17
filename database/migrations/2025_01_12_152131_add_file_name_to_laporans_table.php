<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('laporans', function (Blueprint $table) {
        $table->string('file_name')->nullable()->after('dokumen');
    });
}

public function down()
{
    Schema::table('laporans', function (Blueprint $table) {
        $table->dropColumn('file_name');
    });
}

};
