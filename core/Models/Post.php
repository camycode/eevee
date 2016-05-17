<?php

namespace Core\Models;

use Illuminate\Support\Facades\Validator;

class Post extends Model
{

    protected $data = [];

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * 添加 Post
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function addPost()
    {
        $this->validatePost();

        $this->initPost();

        return $this->transaction(function () {

            $this->filter($this->data, $this->fields('POST'));

            $this->resource('POST')->insert($this->data);

        });
    }

    public function updatePost($user_id)
    {

    }

    /**
     * 获取 Post
     *
     * @param $post_id
     *
     * @return mixed
     *
     * @throws \Core\Exceptions\StatusException
     */
    public function getPost($post_id)
    {
        if ($post = $this->resource('POST')->where('id', $post_id)->first()) {

            return status('success', $post);
        }

        exception('postDoesNotExist');

    }

    public function getPosts($params)
    {

    }


    public function deletePost($post_id)
    {

    }

    protected function initPost()
    {

    }

    protected function validatePost()
    {

    }


}