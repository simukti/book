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
    public function getService($service_name)
    {
        return Core_Service_Proxy::get($service_name);
    }
    
    public function disableLayout()
    {
        $this->_helper->layout->disableLayout(true);
    }
    
    public function disableView()
    {
        $this->_helper->viewRenderer->setNoRender(true);
    }
    
    public function gotoRouteAndExit(array $urlOptions = array(), $name = null, $reset = false)
    {
        $this->_helper->redirector->gotoRouteAndExit($urlOptions, $name, $reset);
    }
}
