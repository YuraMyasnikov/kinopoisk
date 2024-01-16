
<?php

define('MAIN_PATH', dirname(__DIR__));
require_once MAIN_PATH.'/vendor/autoload.php';
use App\Kernel\App;

$app = new App();
$app->run();
