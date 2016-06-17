<?php

namespace Core\Middleware;

use Closure;
use Core\Logs\AccessLog;


class Authenticate
{
    /**
     * 访问控制中间件
     *
     */
    public function handle($request, Closure $next)
    {
        return $next($this->request);

    }

}
