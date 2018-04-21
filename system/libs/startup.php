<?php
// Error Reporting
error_reporting(E_ALL);

// Check Version
if (version_compare(phpversion(), '5.3.0', '<') == true) {
    exit('PHP5.3+ Required');
}
// Setting Timezone
//if (!ini_get('date.timezone')) {
    $timezone = date_default_timezone_set('Asia/Dhaka');
//}

if (!isset($_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'] = substr($_SERVER['PHP_SELF'], 1);

    if (isset($_SERVER['QUERY_STRING'])) {
        $_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
    }
}

if (!isset($_SERVER['HTTP_HOST'])) {
    $_SERVER['HTTP_HOST'] = getenv('HTTP_HOST');
}

// Autoloader
/*
spl_autoload_register(function($class) {
    include_once "system/libs/" . $class . ".php";
});
*/

function library($class) {
    $file = DIR_SYSTEM . 'libs/' . str_replace('\\', '/', strtolower($class)) . '.php';

    if (is_file($file)) {
        include_once($file);

        return true;
    } else {
        return false;
    }
}

spl_autoload_register('library');
spl_autoload_extensions('.php');

// Helper
//require_once(DIR_SYSTEM . 'helper/general.php');
//require_once(DIR_SYSTEM . 'helper/utf8.php');

function start($engine) {
    $main = new Main();
}