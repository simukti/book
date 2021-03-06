<?php

/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * RecordAbstract
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
abstract class Core_Doctrine_RecordAbstract extends Doctrine_Record
{
    /**
     * Proxy to a registered service
     * 
     * @param string $service_name Service class name
     * @return Core_Service_ServiceAbstract
     */
    public function getService($service_name)
    {
        return Core_Service_Proxy::get($service_name);
    }
}
