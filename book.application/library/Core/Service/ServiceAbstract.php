<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Core_Service_ServiceAbstract
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Core_Service_ServiceAbstract implements Zend_Acl_Resource_Interface
{
    /**
     * @var string
     */
    protected $_resourceId;
    
    /**
     * @var Model_Acl
     */
    protected $_acl;
    
    /**
     * @var Zend_Cache_Core
     */
    protected $_cache;
    
    /**
     * Default acl model
     * 
     * @var Model_Acl
     */
    protected static $_aclModel;
    
    /**
     * Prepared services
     * 
     * @var array
     */
    protected static $_services = array();
    
    /**
     * Default user service 
     * 
     * @var User_Service_User
     */
    protected static $_userService;
    
    /**
     * Register default acl model classname and default user service classname 
     * for authentication.
     * 
     * @param string $aclModel    Base Acl model
     * @param string $userservice Base user service for authentication
     */
    public static function setAclModelAndUserService($aclModel, $userservice)
    {
        if (null === self::$_aclModel) {
            self::$_aclModel = new $aclModel;
        }
        
        if (null === self::$_userService) {
            self::$_userService = $userservice;
        }
    }
    /**
     * Register all service you want to load.
     * 
     * @todo This is still an experimental registrar, it will load all instance of registered
     *        service class name on bootstrap. 
     *        Please fix this with separated lazy loading service container.
     * @param array $services List of service namespace / class name
     */
    public static function registerServices(array $services)
    {
        foreach ($services as $service) {
            if (! class_exists($service)) {
                throw new Zend_Loader_Exception(sprintf("Class %s does not exists.", $service));
            }
            $service_instance = new $service;
            
            if (! $service_instance instanceof Core_Service_ServiceAbstract) {
                throw new Zend_Loader_Exception(sprintf("Service %s is not an instance of Core_Service_ServiceAbstract.", $service));
            }
            
            self::$_services[$service] = $service_instance;
        }
    }
    
    /**
     * Get a registered service instance
     * 
     * @param string $service_name Service class name
     * @return Core_Service_ServiceAbstract
     */
    public static function getService($service_name) {
        if (isset (self::$_services[$service_name])) {
            return self::$_services[$service_name];
        } else {
            throw new Zend_Loader_Exception(sprintf("Service %s has not been registered yet.", $service_name));
        }
    }
    
    /**
     * Check user's priviledge of given resource
     * 
     * @param string $permissions
     * @param Zend_Acl_Role_Interface $user
     * @return boolean
     */
    public function checkAcl($permissions, Zend_Acl_Role_Interface $user = null)
    {
        if (null === $user) {
            if (Zend_Auth::getInstance()->hasIdentity()) {
                $user = self::getService(self::$_userService)->getCurrentUser()->role;
            } else {
                $user = self::getService(self::$_userService)->getCurrentUser();
            }
        }

        return $this->getAcl()->isAllowed($user, $this, $permissions);
    }
    
    /**
     * Setup resource ACL
     * 
     * @return void
     */
    protected function _setAcl()
    {}
    
    /**
     * Get default Acl
     * 
     * @return Zend_Acl
     */
    public function getAcl()
    {
        if (null === $this->_acl) {
            $this->_acl = self::$_aclModel;
            $this->_acl->add($this);

            $this->_setAcl();
        }

        return $this->_acl;
    }
    
    protected function _setCache()
    {}
    
    /**
     * Get default cache object (24 hours) for db query result.
     * 
     * @return Zend_Cache_Core
     */
    public function getCache()
    {
        if (null === $this->_cache) {
            $cache = Zend_Cache::factory(
                'Core',
                'File',
                array(
                    'lifetime'                => 3600 * 24,
                    'automatic_serialization' => true
                ),
                array(
                    'cache_dir'              => CACHE_PATH . DS . 'query' . DS,
                )
            );
            $this->_cache = $cache;
            $this->_setCache();
        }
        
        return $this->_cache;
    }
    
    /**
     * @see     Zend_Acl_Resource_Interface::getResourceId()
     * @return string
     */
    public function getResourceId()
    {
        return $this->_resourceId;
    }
}
