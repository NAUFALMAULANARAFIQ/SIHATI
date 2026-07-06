<?php

if (!function_exists('removeQuery')) {
    function removeQuery(string $key): string
    {
        $params = request()->query();
        unset($params[$key]);
        if (str_ends_with($key, '[]') || str_ends_with($key, 's')) {
            $base = preg_replace('/\[.*\]$/', '', $key);
            $base = rtrim($base, 's');
            unset($params[$base]);
            unset($params[$base . '[]']);
        }
        return url()->current() . (count($params) > 0 ? '?' . http_build_query($params) : '');
    }
}
