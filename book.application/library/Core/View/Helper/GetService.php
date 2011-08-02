<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * GetService
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Core_View_Helper_GetService// extends Zend_View_Helper_Abstract
{
    /**
     * This is a proxy to registered service
     * 
     * @param string $service_name Service class name
     * @return Core_Service_ServiceAbstract
     */
    public function getService($service_name)
    {
        return Core_Service_Proxy::get($service_name);
    }
}
