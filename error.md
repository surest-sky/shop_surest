# 错误的内容

## cp: omitting directory

    需要递归子目录， 使用cp -r
    
## 使用外键关联的时候，不能添加外键

    关联的外键和当前的键类型不一致
    自增id 为 unsigned 
    $table->integer('user_id')->unsigned(); /
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    
x