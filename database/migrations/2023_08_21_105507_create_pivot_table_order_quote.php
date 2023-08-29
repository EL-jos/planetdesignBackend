<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTableOrderQuote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_quote', function (Blueprint $table) {
            $table->string('order_id');
            $table->string('quote_id');

            $table->foreign('order_id')->references('id')->on('orders')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('quote_id')->references('id')->on('quotes')
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
        Schema::dropIfExists('order_quote');
    }
}
