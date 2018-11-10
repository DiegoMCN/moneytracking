<?php

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__FILE__)) . DS);
define("APP_PATH", ROOT . "Application" . DS);

require './Application/Config.php';
require __DIR__ . '/vendor/autoload.php';

try{
    \Application\Bootstrap::run(new \Application\Request());
} catch (Exception $e){
    echo $e->getMessage();
}