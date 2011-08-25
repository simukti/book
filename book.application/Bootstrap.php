<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Application Bootstrap
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Initiate default resource loader without "namespace" prefix
     * 
     * @return Zend_Application_Module_Autoloader 
     */
    protected function _initDefaultResourceLoader()
    {
        $resourceLoader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath'  => MODULE_PATH . DS . 'default',
        ));
        return $resourceLoader;
    }
    
    /**
     * Initiate route and remove default zend_framework route
     * 
     * @return Zend_Controller_Router_Rewrite
     */
    protected function _initDefaultRoute()
    {
        $router = $this->getPluginResource('Router')->getRouter();
        $router->removeDefaultRoutes();
        return $router;
    }
    
    /**
     * Initiate default doctrine connection
     * 
     * @return Doctrine_Connection
     */
    protected function _initDoctrine()
    {
        $manager = Doctrine_Manager::getInstance();
        $manager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
        $manager->setAttribute(Doctrine_Core::ATTR_MODEL_LOADING, Doctrine_Core::MODEL_LOADING_CONSERVATIVE);
        $manager->setAttribute(Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES, true);
        $manager->setAttribute(Doctrine_Core::ATTR_QUOTE_IDENTIFIER, true);
        $manager->setAttribute(Doctrine_Core::ATTR_AUTO_FREE_QUERY_OBJECTS, true);
        $option = $this->getOption('doctrine');
        $connection = Doctrine_Manager::connection($option['dsn'], 'minilib');
        $connection->setAttribute(Doctrine_Core::ATTR_USE_NATIVE_ENUM, true);
        return $connection;
    }
    
    /**
     * Initiate default acl model and set user service class name
     */
    protected function _initDefaultService()
    {
        Core_Service_ServiceAbstract::setAclModelAndUserService(
                'Model_Acl', 
                'User_Service_User'
        );
    }
    
    /**
     * Initiate Zend_Session and start with default options
     */
    protected function _initSession()
    {
        $options = array(
            'use_only_cookies' => true,
            'cookie_httponly' => true,
            'name' => 'minilib_' . strtolower(APPLICATION_ENV)
        );
        Zend_Session::start($options);
    }
    
    /**
     * Just to check what I have include
     */
    /*
    protected function _initLoaderCache()
    {
        if ('production' === APPLICATION_ENV) {
            $classFileIncCache = CACHE_PATH . DS . 'class' . DS . 'loaderCache.php';
            if (file_exists($classFileIncCache)) {
                include_once $classFileIncCache;
            }
            Zend_Loader_PluginLoader::setIncludeFileCache($classFileIncCache);
        }
    }
    
    */
}
