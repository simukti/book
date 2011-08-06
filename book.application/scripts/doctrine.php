<?php
/**
 * Create Base table model abstract from database (Doctrine_Record)
 */
error_reporting(E_ALL);

define('ROOT_PATH', realpath(dirname(__FILE__)));
define('APPLICATION_PATH', realpath(dirname(__FILE__) . "/../"));
define('APPLICATION_ENV', 'production');
define('APP_LIB_PATH',
        APPLICATION_PATH . '/library');

set_include_path(implode(PATH_SEPARATOR, array(
    //application library
    APP_LIB_PATH ,
    // include zend framework library if it's not include in php.ini
    // get all the php.ini include path(s)
    get_include_path(),
)));

/* Make sure you have Zend Framework + Doctrine on your include_path */
require_once 'Zend/Application.php';

// Create application, and use main application config
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

// Read in the application.ini bootstrap for Doctrine
$application->getBootstrap()->bootstrap('doctrine');
$config = $application->getOption('doctrine');
Doctrine_Core::generateModelsFromDb(APPLICATION_PATH . '/library/Minilib', array('minilib'), array(
    'phpDocPackage'         =>'Minilib',
    'phpDocSubpackage'      =>'MainModel',
    'phpDocName'            =>'Sarjono Mukti Aji',
    'phpDocEmail'           =>'simukti@facebook.com',
    'phpDocVersion'         =>'1.1',
    'pearStyle'             => true,
    'suffix'                => '.php', 
    'baseClassName'         => 'Core_Doctrine_RecordAbstract',
    'baseClassesDirectory'  => NULL,
    'classPrefix'           => 'Minilib_',
    'classPrefixFiles'      => false,
    'generateBaseClasses'   => false,
    'generateTableClasses'  => false,
    'packagesFolderName'    => 'Minilib',
));
