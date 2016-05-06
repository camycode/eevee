<?php

namespace Core\Models;

use Illuminate\Support\Facades\Validator;

class Term extends Model
{

    protected $data = [];

    /**
     * 绑定分类操作数据
     *
     * @param $data array
     *
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * 添加分类
     *
     * @return Status
     */
    public function addTerm()
    {
        $this->validateTerm();
        $this->filter($this->data, $this->fields('TERM'));
        $this->resource('TERM')->insert($this->data);

        return $this->getTerm($this->data['id']);
    }

    /**
     * 更新分类
     *
     * @param $term_id
     *
     * @return Status
     */
    public function updateTerm($term_id)
    {
        $this->validateTerm();
        $this->filter($this->data, $this->fields('TERM'));
        $this->resource('TERM')->where('id', $term_id)->update($this->data);

        return $this->getTerm($term_id);

    }

    /**
     * 获取分类
     *
     * @param $term_id
     *
     * @return Status
     *
     * @throws \Core\Exceptions\StatusException
     */
    public function getTerm($term_id)
    {
        if ($term = $this->resource('TERM')->where('id', $term_id)->first()) {

            return status('success', $term);
        }

        exception('termDoesNotExist');
    }


    /**
     * 删除分类
     *
     * @param $term_id
     *
     * @return Status
     */
    public function deleteTerm($term_id)
    {
        $this->getTerm($term_id);
        $this->resource('TERM')->where('id', $term_id)->delete();

        return status('success');
    }

    protected function validateTerm()
    {

    }


}