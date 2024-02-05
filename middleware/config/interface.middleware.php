<?php

interface Middleware_Interface {
    public function handle($request, Closure $next);
}