<?php

namespace Core\Controllers;

use Core\Services\Context;

class BackendController extends Controller
{

    public function getPlugin($name, Context $context)
    {
        if (!$context->request->session()->has('access_user')) {

            return redirect('/backend/login');
        }

        ob_start();

        $view = base_path("content/plugins/$name/view.php");

        if (file_exists($view)) {

            include $view;
        }

        $content = ob_get_contents();

        ob_end_clean();

        $access_user = $context->request->session()->get('access_user');

        return response(view('backend.layout', [
            'access_user' => $access_user,
            'content' => $content,
        ]));

    }

    public function getLogin(Context $context)
    {

        if ($context->request->session()->has('access_user')) {

            return redirect('/backend/core');
        }

        return response(view('backend.login'));

    }

}