<?php

namespace App\Providers;

use App\Services\Context;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class ContextServiceProvider extends ServiceProvider
{
    /**
     * 注册上下文对象
     */
    public function register()
    {
        $this->app->bind('App\Services\Context', function ($app) {

          return new Context($app->request, (new Response()));
      });
    }
}
