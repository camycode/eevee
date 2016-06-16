<?php

namespace Core\Controllers;

use Core\Models\User;
use Core\Services\Context;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    const user_status_common = 'common';

    const user_status_forbidden = 'forbidden';

    const user_default_avatar = '/images/avatar.png';

    const user_default_role = 'guest';

    const user_default_source = 'admin';

    protected function initializeUser(array $data)
    {
        $initialize = [
            'id' => $this->id(),
            'role' => self::user_default_role,
            'avatar' => self::user_default_avatar,
            'source' => self::user_default_source,
            'status' => self::user_status_common,
        ];

        return array_merge($initialize, $data);
    }

    protected function validateUser(array $data, array $ignore = [])
    {

        $rule = [
            'id' => 'required|unique:user',
            'username' => 'required|unique:user',
            'email' => 'required|unique:user',
            'role' => 'required',
        ];

        $this->ignore($data, $ignore);

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {

            exception('ValidateFailed', $validator->errors());
        }

    }


    public function getUser(Context $context)
    {

        if ($user = User::find($context->param('id'))) {

            return $context->status('success', $user);
        }

        exception('UserDoesNotExist');
    }

    public function getUsers(Context $context)
    {
        return $context->status('success', $this->selector('user', $context->params()));
    }

    public function postUser(Context $context)
    {

        $data = $this->initializeUser($context->data());

        $this->validateUser($data);

        $data['password'] = User::encryptPassword($data['password']);

        if (User::create($data)) {

            return $context->status('success', User::find($data['id']));
        }

        exception('PostUserFailed');
    }

}