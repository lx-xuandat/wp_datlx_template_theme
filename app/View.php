<?php

namespace Datlx\Avaocuoi;

class View
{
    public const TEMPLATE_PATH = __DIR__;

    public static function menu($name, array $data)
    {
        ob_start();
        extract($data, EXTR_SKIP);
        require dirname(__FILE__, 2) . '/resources/views/menus/' . $name . '.php';
        return ob_end_flush();
    }
}
