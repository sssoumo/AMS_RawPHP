<?php

// Version
define('VERSION', '1.0.0');

// Configuration
if (is_file('config.php'))
    require_once('config.php');
else
    die("Configuration failed!");

// Startup
require_once(DIR_SYSTEM . 'libs/startup.php');
start('app');