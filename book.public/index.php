<?php
// Define directory separator constant
define('DS', DIRECTORY_SEPARATOR);

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH',
       realpath(dirname(__FILE__) . DS . '..' . DS . 'book.application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV',
       (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// define configuration path
define('CONFIG_PATH',
        APPLICATION_PATH . DS . 'configs' . DS);

// define application library path
define('APP_LIB_PATH',
        APPLICATION_PATH . DS . 'library');

// define /var path
define('VAR_PATH',
        APPLICATION_PATH . DS . 'var' . DS);

// define /var path
define('MODULE_PATH',
        APPLICATION_PATH . DS . 'modules');

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    //application library
    APP_LIB_PATH ,
    // include zend framework library if it's not include in php.ini
    // get all the php.ini include path(s)
    get_include_path(),
)));

require_once APP_LIB_PATH . DS . 'Core'. DS . 'Bootloader.php';
Core_Bootloader::loadApplication();