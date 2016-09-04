<?php


global $app;

use Core\Services\Context;


set_connection('account_book_mysql', [
    'driver' => 'mysql',
    'host' => env('DB_HOST', 'localhost'),
    'port' => env('DB_PORT', 3306),
    'database' => 'ximuop',
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => 'xi_',
    'timezone' => env('DB_TIMEZONE', '+00:00'),
    'strict' => false,
]);


/**
 * 获取账单字段
 *
 * @return array
 */
function get_account_book_bill_fields()
{

    return ['id', 'user_id', 'sum', 'type', 'status', 'notes', 'created_at', 'updated_at'];
}

/**
 * 验证账本账单
 *
 * @param array $data
 *
 * @return mixed
 */
function validate_account_book_bill(array $data)
{

    $rule = [
        'user_id' => 'required',
        'sum' => 'required',
        'notes' => 'required',
    ];

    $message = [
        'sum.required' => '金额不能为空',
        'notes.required' => '备注不能为空',
    ];

    return validate($data, $rule, $message);

}

$app->get('/bill/list', function (Context $context) {

    return $context->status('success', selector(connection('account_book_mysql')->table('account_book_bills'), $context->params()));

});

$app->post('/bill', function (Context $context) {

    $data = $context->data();

    if (($result = validate_account_book_bill($data)) !== true) {

        exception('ValidateError', $result);
    };

    filter_fields($data, get_account_book_bill_fields());

    $data['id'] = id();
    $data['created_at'] = timestamp();

    if (connection('account_book_mysql')->table('account_book_bills')->insert($data)) {

        return $context->status('success');
    } else {

        return $context->status('error');
    }


});