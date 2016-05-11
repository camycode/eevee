<?php

namespace Core\Models;

class Term extends Model
{

    protected $data = [];
    private  $_id;

    /**
     * @Author LuoChao
     * @FunctionName setData
     * @param array $data
     * @return $this
     * @explain 绑定分类操作数据
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @Author LuoChao
     * @FunctionName addTerm
     * @return Status
     * @throws \Exception
     * @explain 添加分类
     */
    public function addTerm()
    {
        $this->validateTerm();
        $this->transaction(function(){
            if($this->filter($this->data, $this->fields('TERM'))){
                $insert_result = $this->resource('TERM')->insert($this->data);
                if($insert_result){
                    $inserted_data = $this->getTermForUnique($this->data['unique_tag']);
                    if($inserted_data){
                        $id = $inserted_data->data->id;
                        $this->_id = $id;
                        if(! empty($id)){
                            if(empty($this->data['fid'])){
                                $updatedata['fid'] = 0;
                                $updatedata['path'] = $id;
                            }
                            else{
                                $fid_data = $this->getTerm($inserted_data->data->fid);
                                $updatedata['path'] = $fid_data->data->path.",".$id;
                            }
                        }
                    }
                    $this->data = $updatedata;
                    $this->updateTerm($id);
                }
            }
        });
        return $this->getTerm($this->_id);
    }

    /**
     * @Author LuoChao
     * @FunctionName updateTerm
     * @param $term_id
     * @return Status
     * @explain 更新分类
     */
    public function updateTerm($term_id)
    {
        $this->validateTerm();
        $this->filter($this->data, $this->fields('TERM'));
        $this->resource('TERM')->where('id', $term_id)->update($this->data);

        return $this->getTerm($term_id);

    }

    /**
     * @Author LuoChao
     * @FunctionName getTerm
     * @param $term_id
     * @return Status
     * @throws \Core\Exceptions\StatusException
     * @explain 获取分类
     */
    public function getTerm($term_id)
    {
        if ($term = $this->resource('TERM')->where('id', $term_id)->first()) {

            return status('success', $term);
        }

        exception('termDoesNotExist');
    }

    /**
     * @Author LuoChao
     * @FunctionName getTermForUnique
     * @param $term_id
     * @return Status
     * @throws \Core\Exceptions\StatusException
     * @explain 获取分类(通过唯一标识符)
     */
    public function getTermForUnique($term_id)
    {
        if ($term = $this->resource('TERM')->where('unique_tag', $term_id)->first()) {

            return status('success', $term);
        }

        exception('termDoesNotExist');
    }

    /**
     * @Author LuoChao
     * @FunctionName deleteTerm
     * @param $term_id
     * @return Status
     * @explain 删除分类
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