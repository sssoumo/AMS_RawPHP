<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

# Base URL
define('BASE_URL', 'http://localhost/RFAttendanceSystem/');

# General Configuration
define('DIR_SYSTEM', 'system/');
define('DIR_APP', 'app/');
define('DIR_CONTROLLER', DIR_APP . 'controller/');
define('DIR_VIEW', DIR_APP . 'view/');
define('DIR_MODEL', DIR_APP . 'model/');
define('DIR_THEME', DIR_VIEW . 'theme/');

# Default theme
define('THEME_DEFAULT', 'gray');

define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_ROUTE', 'index');

define('APP_TITLE', 'RF Attendance System');

# Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'attendance');
define('DB_USERNAME', 'attendance');
define('DB_PASSWORD', '123456');