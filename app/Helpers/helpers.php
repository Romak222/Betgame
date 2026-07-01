<?php

if (! function_exists('app_name')) {

    function app_name(): string
    {
        return config('app.name');
    }

}

if (! function_exists('active_menu')) {

    function active_menu($route): string
    {
        return request()->routeIs($route)
            ? 'active'
            : '';
    }

}