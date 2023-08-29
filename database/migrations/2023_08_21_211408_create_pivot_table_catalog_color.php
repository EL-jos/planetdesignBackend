<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTableCatalogColor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_color', function (Blueprint $table) {
            $table->string('catalog_id');
            $table->unsignedBigInteger('color_id');

            $table->foreign('catalog_id')->references('id')->on('catalogs')
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
        Schema::dropIfExists('catalog_color');
    }
}
