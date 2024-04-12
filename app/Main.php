<?php

namespace Datlx\Avaocuoi;

class Main
{
    public const TEMPLATE_PATH = __DIR__;
    public static array $containers;

    public function __construct()
    {
        $services = require DATLX_THEME_PATH . "/app/configs/services.php";

        foreach ($services as $service) {
            self::$containers[$service] = new $service;
        }
    }
    public static function view($path)
    {
        return dirname(__FILE__, 2) . '/template-parts/' . $path;
    }
}
