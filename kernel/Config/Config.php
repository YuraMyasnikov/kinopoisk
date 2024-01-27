<?php

namespace App\Kernel\Config;

use App\Kernel\Config\ConfigInterface;

class Config implements ConfigInterface
{

    public function get(string $key, $default = null): mixed
    {
        //$key = "database.driver"

        [$file, $key] = explode('.', $key); // задача получить ['database' , 'driver']

        $configFilePath = MAIN_PATH . "/config/$file.php"; // $configFilePath = c:/.../config/database.php

        if (! file_exists($configFilePath)) // проверка существует ли такой файл
        {
            return $default; // = null | когда такой файл
        }

        $config = require $configFilePath; // config - стал содержимым файла из строки ведущий до него


        return $config[$key] ?? $default; // получаю значение из массива
    }
}