<?php

require_once "vendor/autoload.php";

importFiles('../Controllers');
importFiles('../Models');
function importFiles($dir){
    foreach (scandir($dir) as $value){
        if(!in_array($value, ['.', '..'])){
            require_once "$dir/$value";
        }
    }
}

function print_p(...$args){
    foreach ($args as $arg){
       echo "<pre>";
        print_r($arg);
       echo "</pre>";
       echo "<br>";

    }
}

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Configure the database and boot Eloquent
 */
$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'mysql',
    'database'  => 'event',
    'username'  => 'user',
    'password'  => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix'    => ''
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
// set timezone for timestamps etc
date_default_timezone_set('UTC');
