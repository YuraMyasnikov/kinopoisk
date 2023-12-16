<?php

const MAIN_PATH = __DIR__;
require_once MAIN_PATH.'/vendor/autoload.php';
use App\App;

$app = new App();

$app->run();
