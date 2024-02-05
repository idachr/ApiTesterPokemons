<?php

class Middleware_Dispatcher
{
    private $middlewares = [];

    private $index = 0;

    public function __construct(array $middlewares)
    {
        $this->middlewares = $middlewares;
    }

    public function dispatch($request)
    {
        if ($this->index < count($this->middlewares)) {
            $middleware = new $this->middlewares[$this->index];
            $this->index++;
            return $middleware->handle($request, function ($request) {
                return $this->dispatch($request);
            });
        }
    }
}