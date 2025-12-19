<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalViewsTable extends Migration
{

    public function up(): void
    {
        Schema::create('journal_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('journal_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ip')->nullable();
            $table->timestamps();

            $table->foreign('journal_id')->references('id')->on('journals')->onDelete('cascade');
            $table->index(['journal_id', 'user_id']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('journal_views');
    }
}
