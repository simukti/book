<?php
define('DS', DIRECTORY_SEPARATOR);
defined('APPLICATION_PATH') || define('APPLICATION_PATH',
       realpath(dirname(__FILE__) . DS . '..' . DS . 'book.application'));
defined('APPLICATION_ENV') || define('APPLICATION_ENV',
       (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
define('CONFIG_PATH',   APPLICATION_PATH . DS . 'configs' . DS);
define('APP_LIB_PATH',  APPLICATION_PATH . DS . 'library');
define('VAR_PATH',      APPLICATION_PATH . DS . 'var' . DS);
define('MODULE_PATH',   APPLICATION_PATH . DS . 'modules');

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    APP_LIB_PATH , 
    get_include_path(),
)));

/* Call bootloader, pre-check, and run application */
require_once APP_LIB_PATH . DS . 'Core'. DS . 'Bootloader.php';
Core_Bootloader::loadApplication();