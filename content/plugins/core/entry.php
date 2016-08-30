<?php

global $app;

include 'system.php';
include 'app.php';
include 'user.php';
include 'auth.php';
include 'tag.php';
include 'term.php';
include 'post.php';
include 'file.php';
include 'folder.php';

use Core\Services\Context;


/**
 * 获取系统配置列表
 */
$app->get('/system/config/list', function (Context $context) {

    return $context->status('success', get_system_config($context->params()));

});


/*
|--------------------------------------------------------------------------
| 系统配置
|--------------------------------------------------------------------------
*/

/**
 * 添加系统配置
 */
$app->post('/system/config', function (Context $context) {

    $data = $context->data();

    initialize_system_config($data);

    $check = validate_system_config($data, true);

    if ($check === true) {

        return $context->status('success', add_system_config($data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 更新系统配置
 */
$app->put('/system/config/{id}', function ($id, Context $context) {


    $data = $context->data();

    initialize_system_config($data);

    $check = validate_system_config($data, false);

    if ($check === true) {

        return $context->status('success', update_system_config($id, $data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 获取系统配置列表
 */
$app->get('/system/config/list', function (Context $context) {

    return $context->status('success', get_system_config($context->params()));

});


/**
 * 获取系统配置
 */
$app->get('/system/config/{id}', function ($id, Context $context) {

    if ($app = the_system_config($id)) {

        return $context->status('success', $app);

    } else {

        return $context->status('appDoesNotExist');
    }


});


/**
 * 删除系统配置
 */
$app->delete('/system/config/{id}', function ($id, Context $context) {

    return $context->status('success', delete_system_config($id));

});

/*
|--------------------------------------------------------------------------
| 应用
|--------------------------------------------------------------------------
*/

/**
 * 添加应用
 */
$app->post('/app', function (Context $context) {

    $data = $context->data();

    initialize_app($data);

    $check = validate_app($data, true);

    if ($check === true) {

        return $context->status('success', add_app($data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 更新应用
 */
$app->put('/app/{id}', function ($id, Context $context) {


    $data = $context->data();

    initialize_app($data);

    $check = validate_app($data, false);

    if ($check === true) {

        return $context->status('success', update_app($id, $data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 获取应用列表
 */
$app->get('/app/list', function (Context $context) {

    return $context->status('success', get_app($context->params()));

});


/**
 * 获取应用
 */
$app->get('/app/{id}', function ($id, Context $context) {

    if ($app = the_app($id)) {

        return $context->status('success', $app);

    } else {

        return $context->status('appDoesNotExist');
    }


});


/**
 * 删除应用
 */
$app->delete('/app/{id}', function ($id, Context $context) {

    return $context->status('success', delete_app($id));

});


/*
|--------------------------------------------------------------------------
| 用户
|--------------------------------------------------------------------------
*/

/**
 * 添加用户
 */
$app->post('/user', function (Context $context) {

    $data = $context->data();

    initialize_user($data);

    $check = validate_user($data, true);

    if ($check === true) {

        return $context->status('success', add_user($data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 更新用户
 */
$app->put('/user/{id}', function ($id, Context $context) {


    $data = $context->data();

    initialize_user($data);

    $check = validate_user($data, false);

    if ($check === true) {

        return $context->status('success', update_user($id, $data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 获取用户列表
 */
$app->get('/user/list', function (Context $context) {

    return $context->status('success', get_user($context->params()));

});


/**
 * 获取用户
 */
$app->get('/user/{id}', function ($id, Context $context) {

    if ($app = the_user($id)) {

        return $context->status('success', $app);

    } else {

        return $context->status('appDoesNotExist');
    }


});


/**
 * 删除用户
 */
$app->delete('/user/{id}', function ($id, Context $context) {

    return $context->status('success', delete_user($id));

});


/*
|--------------------------------------------------------------------------
| 认证
|--------------------------------------------------------------------------
*/

/**
 * 添加分类
 */
$app->post('/login', function (Context $context) {

    $data = $context->data();

    initialize_term($data);

    $check = validate_term($data, true);

    if ($check === true) {

        return $context->status('success', add_term($data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 登录
 */
$app->post('/login', function (Context $context) {

    if ($user = table('user')->where('username', $context->data('username'))->first()) {

        if (!auth_user_password($context->data('password'), $user->password)) {

            exception('InvalidAccountOrUsername');
        }

        $token = save_user_token($context->header('X-App-ID', 'backend'), $context->header('X-App-Version', '1.0.0'), $user->id, $user->password);

        if ($token === false) {

            exception('DatabaseError');
        }

        unset($user->password);

        if ($context->header('X-App-ID') == 'backend') {

            $context->request->session()->put('access_user', (array)$user);
        }

        $user->user_token = $token;

        return $context->status('success', $user);


    } else {
        
        exception('UserDoesNotExist');
    };

});


/*
|--------------------------------------------------------------------------
| 分类
|--------------------------------------------------------------------------
*/

/**
 * 添加分类
 */
$app->post('/term', function (Context $context) {

    $data = $context->data();

    initialize_term($data);

    $check = validate_term($data, true);

    if ($check === true) {

        return $context->status('success', add_term($data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 更新分类
 */
$app->put('/term/{id}', function ($id, Context $context) {


    $data = $context->data();

    initialize_term($data);

    $check = validate_term($data, false);

    if ($check === true) {

        return $context->status('success', update_term($id, $data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 获取分类列表
 */
$app->get('/term/list', function (Context $context) {

    return $context->status('success', get_term($context->params()));

});


/**
 * 获取分类
 */
$app->get('/term/{id}', function ($id, Context $context) {

    if ($app = the_term($id)) {

        return $context->status('success', $app);

    } else {

        return $context->status('appDoesNotExist');
    }


});


/**
 * 删除分类
 */
$app->delete('/term/{id}', function ($id, Context $context) {

    return $context->status('success', delete_term($id));

});

/*
|--------------------------------------------------------------------------
| 标签
|--------------------------------------------------------------------------
*/

/**
 * 添加标签
 */
$app->post('/tag', function (Context $context) {

    $data = $context->data();

    initialize_tag($data);

    $check = validate_tag($data, true);

    if ($check === true) {

        return $context->status('success', add_tag($data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 更新标签
 */
$app->put('/tag/{id}', function ($id, Context $context) {


    $data = $context->data();

    initialize_tag($data);

    $check = validate_tag($data, false);

    if ($check === true) {

        return $context->status('success', update_tag($id, $data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 获取标签列表
 */
$app->get('/tag/list', function (Context $context) {

    return $context->status('success', get_tag($context->params()));

});


/**
 * 获取标签
 */
$app->get('/tag/{id}', function ($id, Context $context) {

    if ($app = the_tag($id)) {

        return $context->status('success', $app);

    } else {

        return $context->status('appDoesNotExist');
    }


});


/**
 * 删除标签
 */
$app->delete('/tag/{id}', function ($id, Context $context) {

    return $context->status('success', delete_tag($id));

});

/*
|--------------------------------------------------------------------------
| 图文
|--------------------------------------------------------------------------
*/

/**
 * 添加图文
 */
$app->post('/post', function (Context $context) {

    $data = $context->data();

    initialize_post($data);

    $check = validate_post($data, true);

    if ($check === true) {

        return $context->status('success', add_post($data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 更新图文
 */
$app->put('/post/{id}', function ($id, Context $context) {


    $data = $context->data();

    initialize_post($data);

    $check = validate_post($data, false);

    if ($check === true) {

        return $context->status('success', update_post($id, $data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 获取图文列表
 */
$app->get('/post/list', function (Context $context) {

    return $context->status('success', get_post($context->params()));

});


/**
 * 获取图文
 */
$app->get('/post/{id}', function ($id, Context $context) {

    if ($app = the_post($id)) {

        return $context->status('success', $app);

    } else {

        return $context->status('appDoesNotExist');
    }


});


/**
 * 删除图文
 */
$app->delete('/post/{id}', function ($id, Context $context) {

    return $context->status('success', delete_post($id));

});


/*
|--------------------------------------------------------------------------
| 文件
|--------------------------------------------------------------------------
*/

/**
 * 添加文件
 */
$app->post('/file', function (Context $context) {

    $data = $context->data();

    initialize_file($data);

    $check = validate_file($data, true);

    if ($check === true) {

        return $context->status('success', add_file($data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 更新文件
 */
$app->put('/file/{id}', function ($id, Context $context) {


    $data = $context->data();

    initialize_file($data);

    $check = validate_file($data, false);

    if ($check === true) {

        return $context->status('success', update_file($id, $data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 获取文件列表
 */
$app->get('/file/list', function (Context $context) {

    return $context->status('success', get_file($context->params()));

});


/**
 * 获取文件
 */
$app->get('/file/{id}', function ($id, Context $context) {

    if ($app = the_file($id)) {

        return $context->status('success', $app);

    } else {

        return $context->status('appDoesNotExist');
    }


});


/**
 * 删除文件
 */
$app->delete('/file/{id}', function ($id, Context $context) {

    return $context->status('success', delete_file($id));

});

/*
|--------------------------------------------------------------------------
| 文件夹
|--------------------------------------------------------------------------
*/

/**
 * 添加文件夹
 */
$app->post('/folder', function (Context $context) {

    $data = $context->data();

    initialize_folder($data);

    $check = validate_folder($data, true);

    if ($check === true) {

        return $context->status('success', add_folder($data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 更新文件夹
 */
$app->put('/folder/{id}', function ($id, Context $context) {


    $data = $context->data();

    initialize_folder($data);

    $check = validate_folder($data, false);

    if ($check === true) {

        return $context->status('success', update_folder($id, $data));
    }

    return $context->status('ValidateFailed', $check);

});


/**
 * 获取文件夹列表
 */
$app->get('/folder/list', function (Context $context) {

    return $context->status('success', get_folder($context->params()));

});


/**
 * 获取文件夹
 */
$app->get('/folder/{id}', function ($id, Context $context) {

    if ($app = the_folder($id)) {

        return $context->status('success', $app);

    } else {

        return $context->status('appDoesNotExist');
    }


});


/**
 * 删除文件夹
 */
$app->delete('/folder/{id}', function ($id, Context $context) {

    return $context->status('success', delete_folder($id));

});



