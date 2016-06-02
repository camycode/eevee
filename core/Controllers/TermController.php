<?php 

namespace Core\Controllers\Term;

use Core\Models\Term;
use Core\Services\Context;
use Core\Controllers\Controller;

class TermController extends Controller
{

    // 获取Term
    public function getTerm(Context $context)
    {
        return $context->response((new Term())->getTerm($context->params('id')));
    }

    // 获取Term组
    public function getTerms(Context $context)
    {
        return $context->response((new Term())->getTerms($context-params()));
    }

    // 添加Term
    public function postTerm(Context $context)
    {
        return $context->response((new Term($context-data))->addTerm());
    }

    // 更新Term
    public function putTerm(Context $context)
    {
        return $context->response((new Term($context-data))->updateTerm($context->params('id')));
    }

    // 删除Term
    public function deleteTerm(Context $context)
    {
        return $context->response((new Term())->deleteTerm($context->params('id')));
    }

}

