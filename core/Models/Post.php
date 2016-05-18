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

            return $this->getPost($this->data['id']);
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

    /**
     * 获取 Posts
     *
     * @param array $params
     *
     * @return Status
     */
    public function getPosts(array $params)
    {
        $roles = $this->selector('POST', $params);

        return status('success', $roles);
    }


    public function deletePost($post_id)
    {

    }

    protected function initPost()
    {
        $this->data = array_merge([
            'id' => $this->id(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ], $this->data);

    }

    protected function validatePost()
    {

    }


}