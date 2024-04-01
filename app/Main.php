<?php

namespace Datlx\Avaocuoi;

class Main
{
    public const TEMPLATE_PATH = __DIR__;
    private $slug;

    public function __construct()
    {
        $this->slug = new MyService();
    }
    
    public static function view($path) {
        return dirname(__FILE__, 2) . '/template-parts/' . $path;
    }

}
