<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePivotColorQuote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_quote', function (Blueprint $table) {
            $table->string('quote_id');
            $table->unsignedBigInteger('color_id');

            $table->foreign('quote_id')->references('id')->on('quotes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('color_id')->references('id')->on('colors')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_quote');
    }
}
