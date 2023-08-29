<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTableArticleMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_material', function (Blueprint $table) {
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('material_id');

            $table->foreign('article_id')->references('id')->on('articles')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('material_id')->references('id')->on('materials')
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
        Schema::dropIfExists('article_material');
    }
}
