<?php

namespace vendor\framework\app;

class View
{
    private static $page;

    public static function view($page)
    {
        self::$page = $page->getContent();
        return self::$page;
    }
}
