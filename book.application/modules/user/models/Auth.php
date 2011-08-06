<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Authentication model
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class User_Model_Auth extends Minilib_User implements Zend_Auth_Adapter_Interface
{
    /**
     * Username for authentication
     * 
     * @var string
     */
    protected $_identity;
    
    /**
     * Password for authentication
     * 
     * @var string
     */
    protected $_credential;
    
    /**
     * role_name of logged in user
     * 
     * @var string
     */
    protected $_roleId;
    
    /**
     * Set username (identity) for authentication
     * 
     * @param string $username
     * @return User_Model_Auth 
     */
    public function setUsername($username)
    {
        $this->_identity = $username;
        return $this;
    }
    
    /**
     * Set password (credential) for authentication
     * 
     * @param string $password
     * @return User_Model_Auth 
     */
    public function setPassword($password)
    {
        $this->_credential = $password;
        return $this;
    }
    
    /**
     * Authenticate username (identity) and password (credential)
     * 
     * @see Zend_Auth_Adapter_Interface::authenticate()
     * @return Zend_Auth_Result 
     */
    public function authenticate()
    {
        if (null === $this->_identity) {
            $exception = 'Username was not set !';
        } elseif (null === $this->_credential) {
            $exception = 'Password was not set !';
        }

        if (isset($exception)) {
            throw new Zend_Auth_Adapter_Exception($exception);
        }
        
        $user = $this->getUserByUsername($this->_identity);
        
        if (! $user) {
            $code    = Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND;
            $message = 'User not found.';
        } elseif ($user->password !== $this->_credential) {
            $code    = Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID;
            $message = 'Password is invalid.';
        } else {
            $code    = Zend_Auth_Result::SUCCESS;
            $message = 'Login success.';
        }

        return new Zend_Auth_Result($code, $this->_identity, array($message));
    }
    
    public function getUserByUsername($username)
    {
        $user = $this->getTable()->findOneByUname($username);
        if ($user) {
            $this->_roleId = $user->role;
            return $user;
        } else {
            return false;
        }
    }
    
}
