<?php


global $app;

use Core\Services\Context;

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


$app->post('/bill', function (Context $context) {

    $data = $context->data();

    if (($result = validate_account_book_bill($data)) !== true) {

        exception('ValidateError', $result);
    };

    filter_fields($data, get_account_book_bill_fields());

    $data['id'] = id();
    $data['created_at'] = timestamp();

    if (table('account_book_bills')->insert($data)) {

        return $context->status('success');
    } else {

        return $context->status('error');
    }


});