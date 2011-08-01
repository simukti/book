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
class User_Bootstrap extends Zend_Application_Module_Bootstrap
{
    protected function _initUserRoute()
    {
        $config = new Zend_Config_Ini(dirname(__FILE__) . DS . 'configs' . DS . 'route.ini', 'user');
        
        $route = $this->getApplication()->getPluginResource('Router')->getRouter();
        $route->addConfig($config->user);
        return $route;
    }
    
    protected function _initUserServices()
    {
        Core_Service_ServiceAbstract::registerServices(array(
            'User_Service_User',
        ));
    }
}
