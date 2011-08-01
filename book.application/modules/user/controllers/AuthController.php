<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * User_AuthController
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class User_AuthController extends Core_Controller_Action
{
    /**
     * @var User_Service_User
     */
    protected $_userService;
    
    /**
     * @see Zend_Controller_Action::init()
     */
    public function init()
    {
        $this->_userService = $this->getService('User_Service_User');
    }
    
    /**
     * Handle user authentication
     * 
     * Route: /login
     */
    public function loginAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) {
            $this->gotoRouteAndExit(array(), 'book-admin');
        }
        
        $request = $this->getRequest();
        $form = $this->_userService->getLoginForm();
        $this->view->loginForm = $form;
        
        if ($request->isPost()) {
            $result = $this->_userService->login($request->getPost());
            if ($result) {
                $this->gotoRouteAndExit(array(), 'book-admin');
            }
        }
    }
    
    /**
     * Clear identity and log the user out of this app.
     * 
     * Route: /logout
     */
    public function logoutAction()
    {
        $this->disableLayout();
        $this->disableView();
        $this->_userService->logout();
        $this->gotoRouteAndExit(array(), 'login');
    }
}
