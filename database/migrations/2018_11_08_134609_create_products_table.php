<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('商品名称');
            $table->text('description')->comment('商品描述');
            $table->integer('category_id')->comment('分类ID');
            $table->decimal('on_sale',10,2)->default(0.00)->comment('销售额');
            $table->double('rating',8,2)->default(2)->comment('评分');
            $table->integer('sold_count')->comment('库存');
            $table->integer('review_count')->default(0)->comment('评论条数');
            $table->decimal('price',10,2)->comment('价格（最低价）');
            $table->enum('actived',['1','0'])->default(1)->comment('是否上架');
            $table->timestamps();
            $table->unique('name');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
