<?php

namespace app;

class ViewRenderer
{
    public static function renderView($view, $params = []) {
        foreach ($params as $key=> $value) {
            $$key = $value;
        }
        include_once __DIR__ ."/views/layout.php";
    }
}