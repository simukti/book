<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Service Proxy
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Core_Service_Proxy
{
    /**
     * Service class loader proxy
     * 
     * @see Core_Service_ServiceAbstract::getService()
     * @param string $service_name      Service class name
     * @return Core_Service_ServiceAbstract
     */
    public static function get($service_name)
    {   
        return Core_Service_ServiceAbstract::getService($service_name);
    }
}
