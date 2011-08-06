<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Custom base Controller_Action
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Core_Controller_Action extends Zend_Controller_Action
{
    /**
     * Proxy to get a service 
     * 
     * @param string $service_name
     * @return Core_Service_ServiceAbstract
     */
    public function getService($service_name)
    {
        return Core_Service_Proxy::get($service_name);
    }
    
    /**
     * Proxy to disable layout entirely
     */
    public function disableLayout()
    {
        $this->_helper->layout->disableLayout(true);
    }
    
    /**
     * Proxy to disable view render
     */
    public function disableView()
    {
        $this->_helper->viewRenderer->setNoRender(true);
    }
    
    /**
     * @see Zend_Controller_Action_Helper_Redirector::gotoRouteAndExit()
     */
    public function gotoRouteAndExit(array $urlOptions = array(), $name = null, $reset = false)
    {
        $this->_helper->redirector->gotoRouteAndExit($urlOptions, $name, $reset);
    }
}
