<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserAndDownloadsToJournalsTable extends Migration
{
    public function up(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->unsignedBigInteger('download_count')->default(0)->after('pdf_path');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }


    public function down(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'download_count']);
        });
    }
}
