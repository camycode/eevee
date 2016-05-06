<?php

namespace Core\Models;

use Illuminate\Support\Facades\Validator;

class Term extends Model
{

    protected $data = [];

    public function setData($data)
    {
        $this->data = $data;
    }

    public function addTerm($user_id, $key, $value)
    {

    }

    public function updateTerm($user_id, $key, $value)
    {

    }

    public function getTerm($user_id, $config_key)
    {

    }


    public function deleteTerm($user_id, $config_key)
    {

    }

    protected function validatePost()
    {

    }


}