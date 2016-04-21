<?php

namespace Core\Models;

use Illuminate\Support\Facades\Validator;

class APP extends Model
{
    protected $data;

    public function setData($data)
    {
        $this->data = $data;
    }

    public function addApp()
    {

    }

    public function updateApp($app_id)
    {

    }

    public function getApp($app_id)
    {

    }

    public function getApps(array $params = [])
    {

    }

    public function deleteApp($app_id)
    {

    }

    protected function validateApp()
    {

        $table = $this->table('APP');

        $rule = [
            'app_id' => "required|unique:$table",
            'app_name' => 'required|unique:$table'
        ];


        $validator = Validator::make($this->data, $rule);

        if ($validator->fails()) {

            return exception('validateFailed', $validator->errors());
        }
        
    }

}