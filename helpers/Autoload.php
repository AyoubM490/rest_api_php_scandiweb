<?php
function autoLoader($class_name){
    $array_paths = array(
        '/models/',
        '/helpers/',
        '/controllers/'
    );
    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}
spl_autoload_register("autoLoader");