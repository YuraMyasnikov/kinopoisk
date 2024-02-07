<?php

namespace App\Kernel\Storage;

use App\Kernel\Config\ConfigInterface;
use App\Kernel\Storage\StorageInterface;

class Storage implements StorageInterface
{

    public function __construct(private ConfigInterface $config)
    {

    }

    public function url(string $path): string
    {
        $appUrl = $this->config->get("app.url");
        return  "$appUrl/storage/$path";
    }

    public function get(string $path): string
    {
        return file_get_contents(MAIN_PATH . "/storage/$path");
    }
}