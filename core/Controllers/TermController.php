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
     * @explain 添加分类
     *
     * @api {post} /api/term 添加分类
     *
     * @apiPermission TERM.POST
     *
     * @apiGroup term
     *
     * @apiDescription 添加分类.
     *
     * @apiParam {String} name        分类名称
     * @apiParam {String} fid         父类id
     * @apiParam {String} path        分类路径
     * @apiParam {String} tag         标识符
     * @apiParam {String} keyword     关键字
     * @apiParam {String} describe    描述
     *
     * @apiParamExample POST方式请求
     * 测试连接：
     * 1：新增分类为二级分类以及二级分类以下时(fid由选择父类时获取)：
     * http://dev.eevee.io/api/term?name=社会新闻&tag=新闻&keyword=冷漠,最火&describe=此处省略......&fid=13297
     * 2：新增分类为一级分类时(不需要传fid)：
     * http://dev.eevee.io/api/term?name=新闻&tag=最新视频&keyword=视频,最火&describe=此处省略......
     * @apiSuccessExample {json} 操作成功:
     * 测试连接1
     * {
     *"code": 200,
     *"message": "操作成功",
     *"data": {
     *"id": 13310,
     *"fid": 13297,
     *"name": "社会新闻",
     *"path": "13294,13295,13297,13310",
     *"tag": "新闻",
     *"keyword": "冷漠,最火",
     *"describe": "此处省略......",
     *"updatetime": "2016-05-12 02:28:48",
     *"createtime": "2016-05-12 02:28:48",
     *"unique_tag": "85c5881416515cb2a98e18c515bc925b"
     *     }
     *}
     * 测试连接2
     * {
     *"code": 200,
     *"message": "操作成功",
     *"data": {
     *"id": 13311,
     *"fid": 0,
     *"name": "新闻",
     *"path": "13311",
     *"tag": "最新视频",
     *"keyword": "视频,最火",
     *"describe": "此处省略......",
     *"updatetime": "2016-05-12 02:29:21",
     *"createtime": "2016-05-12 02:29:21",
     *"unique_tag": "8ae3bc741e0c1b45ca6fe6e75a8c9402"
     *     }
     *}
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
