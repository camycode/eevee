<?php

namespace Core\Middleware;

use Closure;
use Core\Logs\AccessLog;

class Access
{

    protected $access_log = [];

    /**
     * 访问控制中间件
     */
    public function handle($request, Closure $next)
    {

        $this->access_log['method'] = $request->method();
        $this->access_log['uri'] = $request->path();
        $this->access_log['request_params'] = json_encode($request->query());
        $this->access_log['request_data'] = json_encode($request->json()->all());
        $this->access_log['ip'] = $request->ip();
        $this->access_log['access_begin_at'] = date('Y-m-d H:i:s');

        $response = $next($request);

        $content = $response->getContent();

        try {

            $status = json_decode($content);

            $this->access_log['status_code'] = $status->code;
            $this->access_log['status_message'] = $status->message;
            $this->access_log['status_data'] = $status->data;

        } catch (\Exception $e) {

            $this->access_log['status_code'] = 1000;
            $this->access_log['status_message'] = 'Unknown';
            $this->access_log['status_data'] = $content;

        }

        AccessLog::create($this->access_log);

        return $response;
    }

}
