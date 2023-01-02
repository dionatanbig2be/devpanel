<?php
session_start();
require 'config.php';
if ($ambiente == 2) {

    $start_time = microtime(true);
}
spl_autoload_register(function ($class) {

    if (file_exists('controllers/' . $class . '.php')) {
        require 'controllers/' . $class . '.php';
    } else if (file_exists('models/' . $class . '.php')) {
        require 'models/' . $class . '.php';
    } else if (file_exists('viewclass/' . $class . '.php')) {
        require 'viewclass/' . $class . '.php';
    } else if (file_exists('core/' . $class . '.php')) {
        require 'core/' . $class . '.php';
    } else {
        header("Location: 404.html");
    }
});
if (!isset($_SESSION)) {
    session_start();
}
$core = new Core();
$core->Start();

if ($ambiente == 2) {
    $end_time = microtime(true);

    // Calculate script execution time 
    $execution_time = ($end_time - $start_time);
}
