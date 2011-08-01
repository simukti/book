<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Bootstrap
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_Bootstrap extends Zend_Application_Module_Bootstrap
{
    protected function _initBookRoute()
    {
        $config = new Zend_Config_Ini(dirname(__FILE__) . DS . 'configs' . DS . 'route.ini', 'book');
        
        $route = $this->getApplication()->getPluginResource('Router')->getRouter();
        $route->addConfig($config->book);
        return $route;
    }
    
    protected function _initBookServices()
    {
        Core_Service_ServiceAbstract::registerServices(array(
            'Book_Service_Book',
            'Book_Service_Review',
        ));
    }
}
