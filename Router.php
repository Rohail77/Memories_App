<?php

namespace app;

class Router
{
    private array $getRoutes;
    private array $postRoutes;

    public function __construct()
    {

    }

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            $fn = $this->getRoutes[$this->getURL()] ?? null;
        } else {
            $fn = $this->postRoutes[$this->getURL()] ?? null;
        }
        if(!$fn) {
            $this->displayError();
            exit;
        } else {
            call_user_func($fn);
        }
    }

    private function displayError() {
        echo "Page Not Found";
    }

    private function getURL(): string
    {
        $url = $_SERVER['REQUEST_URI'];
        if (str_contains($url, '?')) {
            $url = substr($url, 0, strpos($url, '?'));
        }
        return $url;
    }
}

//echo "<pre>";
//echo $url;
//echo "</pre>";