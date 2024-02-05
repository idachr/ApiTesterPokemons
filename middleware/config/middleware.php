<?php

require_once __DIR__ . '/dispatcher.middleware.php';
require_once __DIR__ . '/../terms.middleware.php';

class Middleware {

    protected $middlewares = [];

    private $global_middlewares = [
        Middleware_Terms::class,
    ];

    public function __construct()
    {
        $all_middlewares = array_merge($this->global_middlewares, $this->middlewares);
        $dispatcher = new Middleware_Dispatcher($all_middlewares);
        $dispatcher->dispatch($_REQUEST);
    }
}