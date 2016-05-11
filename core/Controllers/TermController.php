<?php

namespace Core\Controllers;

use Core\Models\Term;
use Core\Services\Context;
use Core\Services\Tools;

class TermController extends Controller
{

    private $_id;
    private $_fid;
    private $_name;
    private $_path ;
    private $_tag;
    private $_keyword;
    private $_describe;
    private $_updatetime;
    private $_createtime;
    private $unique_tag;
    private $_param = array();

    /**
     * 初始化函数，获取必要参数
     */
    public function __construct(Context $context){
        $this->_id = $context->_getParam('id','');
        $this->_fid = $context->_getParam('fid','');
        $this->_name = $context->_getParam('name','');
        $this->_path = $context->_getParam('path','');
        $this->_tag = $context->_getParam('tag'.'');
        $this->_keyword = $context->_getParam('keyword','');
        $this->_describe = $context->_getParam('describe','');
        $this->_updatetime = date('Y-m-d H:i:s');
        $this->_createtime = date('Y-m-d H:i:s');
        $this->_unique_tag = (new Tools())->create_uniqid();

        $this->_param = array(
            'id'         => $this->_id,
            'fid'        => $this->_fid,
            'name'       => $this->_name,
            'path'       => $this->_path,
            'tag'        => $this->_tag,
            'keyword'    => $this->_keyword,
            'describe'   => $this->_describe,
            'updatetime' => $this->_updatetime,
            'createtime' => $this->_createtime,
            'unique_tag' => $this->_unique_tag,
        );
    }

    /**
     * @Author LuoChao
     * @FunctionName postTerm
     * @param Context $context
     * @return \Core\Services\Response
     * @explain
     */
    public function postTerm(Context $context)
    {
        foreach($this->_param as $k => $v){
            if(! empty($v)){
                $data[$k] = $v;
            }
        }
        return $context->response((new Term())->setData($data)->addTerm());
    }

    /**
     * @Author LuoChao
     * @FunctionName putTerm
     * @param Context $context
     * @return \Core\Services\Response
     * @explain
     */
    public function putTerm(Context $context)
    {
        return $context->response((new Term())->setData($context->data())->updateTerm($context->_getParam('user_id')));
    }

    /**
     * @Author LuoChao
     * @FunctionName getTerm
     * @param Context $context
     * @return \Core\Services\Response
     * @explain
     */
    public function getTerm(Context $context)
    {
        return $context->response((new Term())->getTerm($context->_getParam('user_id')));
    }

    /**
     * @Author LuoChao
     * @FunctionName deleteTerm
     * @param Context $context
     * @return \Core\Services\Response
     * @explain
     */
    public function deleteTerm(Context $context)
    {
        return $context->response((new Term())->deleteTerm($context->_getParam('user_id')));
    }
}
