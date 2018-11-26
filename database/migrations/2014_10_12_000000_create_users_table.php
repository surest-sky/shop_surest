<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique()->nullable()->comment('邮箱');
            $table->string('w_id')->unique()->nullable()->comment('微博登录id');
            $table->string('q_id')->unique()->nullable()->comment('QQ登录id');
            $table->string('x_id')->unique()->nullable()->comment('微信登录id');
            $table->string('phone')->unique()->nullable()->ccomment('手机号');
            $table->string('avatar')->comment('头像');
            $table->enum('active',[0,1])->comment('头像');
            $table->string('password')->nullable()->comment('密码');
            $table->string('salt')->nullable()->comment('加盐串');
            $table->enum('type',['weibo','weixin','qq'])->nullable();
            $table->timestamp('login_at')->nullbale();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
