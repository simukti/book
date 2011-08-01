<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Default Acl
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Model_Acl extends Zend_Acl
{
    /**
     * Setup default application roles
     */
    public function __construct()
    {
        $this->addRole('guest')
             ->addRole('admin');
    }
}
