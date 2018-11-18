<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('src');
            $table->integer('product_id')->nullable()->unsigned();
            $table->integer('product_sku_id')->nullable()->unsigned();
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade');
            $table->foreign('product_sku_id')->references('id')
                ->on('product_skus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
