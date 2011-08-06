<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * User service + authentication
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class User_Service_User extends Core_Service_ServiceAbstract
{
    /**
     * Zend_Acl_Resource
     * 
     * @var string
     */
    protected $_resourceId = 'user';
    
    /**
     * User authentication model
     * 
     * @var User_Model_Auth
     */
    protected $_authModel;
    
    /**
     * @var void
     */
    protected $_currentUser;
    
    /**
     * Login form
     * 
     * @var User_Form_Login
     */
    protected $_loginForm;
    
    /**
     * Get authentication model
     * 
     * @return User_Model_Auth
     */
    public function getAuthModel()
    {
        if (null === $this->_authModel) {
            $this->_authModel = $this->getModel('User_Model_Auth');
        }
        return $this->_authModel;
    }
    
    /**
     * Authenticate user with provided username and password
     * 
     * @param array $data Login data (username + password)
     * @return bool
     */
    public function login(array $data)
    {
        $loginForm = $this->getLoginForm();
        
        $adapter = $this->getAuthModel();
        $adapter->setUsername($data['uname'])
                ->setPassword(sha1($data['passwd']));
        $result = Zend_Auth::getInstance()->authenticate($adapter);
        if (! $result->isValid()) {
            switch ($result->getCode()) {
                case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
                case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
                    $loginForm->getElement('uname')->setErrors(array(
                        'User not found or Password is invalid.'
                    ));
                    $loginForm->getElement('passwd')->setErrors(array(
                        'User not found or Password is invalid.'
                    ));
                    break;
            }
            return false;
        }
        
        return true;
    }
    
    /**
     * Clear session and all user identity
     */
    public function logout()
    {
        Zend_Session::forgetMe();
        Zend_Auth::getInstance()->clearIdentity();
    }
    
    /**
     * Get login form for authentication. 
     * 
     * @return User_Form_Login 
     */
    public function getLoginForm()
    {
        if (null === $this->_loginForm) {
            $this->_loginForm = new User_Form_Login();
        }
        return $this->_loginForm;
    }
    
    /**
     * Get current user
     * 
     * @return Zend_Acl_Role
     */
    public function getCurrentUser()
    {
        $auth = Zend_Auth::getInstance();

        if (! $auth->hasIdentity()) {
            return new Zend_Acl_Role('guest');
        }
        
        if (null === $this->_currentUser) {
            $username = $auth->getIdentity();
            $user     = $this->getAuthModel()->getUserByUsername($username);

            if (! $user) {
                return new Zend_Acl_Role('guest');
            }

            $this->_currentUser = $user;
        }

        return $this->_currentUser;
    }
    
    /**
     * Optional method to check if current user is a admin or not
     * 
     * @return bool True if current user role is "admin"
     */
    public function isAdmin()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $user_role = $this->getCurrentUser()->role;
            if ($user_role === 'admin') {
                return true;
            } 
            return false;
        }
    }
    
    /**
     * Optional method to check if current user is a guest or not
     * 
     * @return bool True if current user is a guest
     */
    public function isGuest()
    {
        $auth = Zend_Auth::getInstance();
        if (! $auth->hasIdentity()) {
            return true;
        }
        return false;
    }
}
