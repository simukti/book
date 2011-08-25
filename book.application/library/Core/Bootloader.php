<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Bootloader
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Core_Bootloader
{
    /**
     * List of main configuration filenames
     *
     * @var array
     */
    protected static $_configFilenames = array(
        'system' => 'application.ini',    //0
    );

    /**
     * List of required PHP extension to run this application
     * 
     * @var array
     */
    protected static $_requiredExtension = array(
        'SPL',
        'curl',
        'json',
        'SimpleXML',
        'mcrypt'
    );

    /**
     * Prerequisites check and start application
     */
    public static function loadApplication()
    {
        self::checkRequirements();
        self::setEnvironment();
        self::checkConfigFiles();
        self::setLoader();
        self::run();
    }

    /**
     * Check PHP version and loaded extension before anything else.
     */
    private static function checkRequirements()
    {
        /** Check php version before entire application executed */
        if(version_compare(phpversion(), '5.2.6', '<') === true) {
            echo '<center><div style="font:.9em/1.5em arial, helvetica, sans-serif;">
                 <h3>Warning</h3><p>I need PHP 5.2.6 or above to run this application.
                 And make sure you have mod_rewrite activated.
                 <br/>Your PHP version is <strong>' . phpversion() . '</strong></p>' .
                 '</div></center>';
            exit;
        }
        /** Check required PHP extensions */
        foreach (self::$_requiredExtension as $name) {
            if (! extension_loaded($name)) {
                echo "<center>PHP5 Extension: <strong>{$name}</strong> is needed to run this application</center>";
                exit;
            }
        }
    }

    /**
     * Set environment
     */
    private static function setEnvironment()
    {
        defined('CONFIG_PATH')
            || define('CONFIG_PATH', APPLICATION_PATH . DS . 'configs');
        defined('VAR_PATH')
            || define('VAR_PATH', APPLICATION_PATH . DS . 'var');
        defined('CACHE_PATH')
            || define('CACHE_PATH', VAR_PATH . DS . 'cache');
        defined('LOG_PATH')
            || define('LOG_PATH', VAR_PATH . DS . 'log');
        defined('MODULE_PATH')
            || define('MODULE_PATH', APPLICATION_PATH . DS . 'modules');
        defined('SYSTEM_CONFIG')
            || define('SYSTEM_CONFIG', CONFIG_PATH . DS . self::$_configFilenames['system']);
    }

    /**
     * Check config files existence
     */
    private static function checkConfigFiles()
    {
        /**
         * Aggregating main configuration filenames
         */
        $coreConfigs = array(
            SYSTEM_CONFIG,
        );

        /**
         * Now, lets begin checking.
         * Exit entire scripts if a config file does not exist.
         */
        foreach ($coreConfigs as $singlefile) {
            $filename = explode(DS, $singlefile, 7);
            if (! file_exists($singlefile)) {
                echo "<center><h2>FATAL ERROR</h2><br /><strong>{$filename[6]} does not exist.</strong></center>";
                exit;
            }
        }
    }

    /**
     * Set Zend_Loader behaviour
     */
    private static function setLoader()
    {
        /** Zend_Loader_Autoloader */
        require_once 'Zend/Loader/Autoloader.php';
        $autoloader = Zend_Loader_Autoloader::getInstance()
                      ->setFallbackAutoloader(true)
                      ->suppressNotFoundWarnings(true);
        
        $autoloader->setDefaultAutoloader(create_function('$class',
            "include str_replace('_', '/', \$class) . '.php';"
        ));
    }

    /**
     * Run main application
     */
    private static function run()
    {
        // Optional Headers
        header('X-Powered-By: Zend Framework + Doctrine');
        header('X-XSS-Protection: 1; mode=block');
        header('X-Author: Sarjono Mukti Aji');

        $application = new Zend_Application(
            APPLICATION_ENV,
            array(
                'config' => array(
                    SYSTEM_CONFIG,
                )
            )
        );
        
        /** bootstrapping and run the application */
        $application->bootstrap()->run();
    }
}
