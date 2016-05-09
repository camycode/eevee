<?php

namespace Core\Controllers;

use Core\Models\Term;
use Core\Services\Context;

class TermController extends Controller
{
    /**
     * @Author LuoChao
     * @FunctionName postTerm
     * @param Context $context
     * @return \Core\Services\Response
     * @explain
     */
    public function postTerm(Context $context)
    {
//        return $context->response((new Term())->addTerm($context->data()));
        return $context->response((new Term())->setData($_REQUEST)->addTerm());//TODO 用于开发，不需要传入的数据必须是json
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
