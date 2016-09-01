<?php

return function ($info, $schema, $context) {


    if ($schema::connection('bmp_mysql')->hasTable('orders')) {

        return $context->status('failed', ['tip' => '目标数据库 orders 表已经存在']);
    }

    $schema::connection('bmp_mysql')->create('orders', function ($table) {

        $table->bigIncrements('id');
        $table->string('name');             // 顾客陈虎
        $table->string('address');          // 送餐地址
        $table->integer('phone');           // 电话
        $table->float('price');             // 总价
        $table->float('discount');          // 折扣
        $table->float('freight');           // 运费
        $table->double('lng',15,8);              // 经度
        $table->double('lat',15,8);              // 纬度
        $table->timestamp('added_on');      // 下单日期
        $table->timestamp('created_at');    // 记录创建日期
        $table->timestamp('updated_at');    // 记录修改日期

    });

    return $context->status('success');
};