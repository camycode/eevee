<?php

return function ($info, $schema, $context) {

	// $schema::create('users', function ($table) {
	// 	$table->increments('id');
	// });
	$schema::connection('ximu_wechat')->create('wechat_access_token', function ($table) {
		$table->increments('id');
		$table->string('access_token');
		$table->string('expire_time');
	});
	return $context->status('success');
};