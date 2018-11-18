<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('no')->unique();
            $table->tinyInteger('total_count')->comment('总量');
            $table->decimal('total_price',8,2)->comment('总价');
            $table->string('address')->comment('收货地址');
            $table->dateTime('payed_at')->nullable()->coment('支付的时间');
            $table->string('pay_method')->nullable()->comment('支付的方式');
            $table->string('pay_status')->default('pending')->comment('支付的方式');
            $table->string('pay_no')->nullable()->comment('支付的订单号');
            $table->string('refund_status')->default('pending')->comment('支付的状态');
            $table->enum('closed',[1,0])->default(0)->comment('支付是否关闭');
            $table->string('reviewed')->nullable()->comment('支付的评论');
            $table->string('ship_status')->default('pending')->comment('物流状态');
            $table->string('ship_data')->default('')->comment('物流信息');
            $table->text('extra')->comment('订单的相关商品详情');
            $table->string('refund_no')->nullable()->comment('退款订单号');
            $table->string('remark')->nullable()->comment('备注');
            $table->dateTime('expir_at')->comment('过期时间');
            $table->string('refund_reason')->nullable()->comment('退款理由');
            $table->string('refund_err')->nullable()->comment('退款的错误信息');
            $table->string('coupon_code')->nullable()->comment('优惠券');
            $table->softDeletes();
            $table->index('no');
            $table->index('user_id');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
