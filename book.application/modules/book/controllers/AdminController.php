<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Book_AdminController
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_AdminController extends Core_Controller_Action
{
    /**
     * Book service for admin
     * 
     * @var Book_Service_Book
     */
    protected $_bookService;
    
    /**
     * Check for authentication and set primary service
     */
    public function init()
    {
        if ($this->getService('User_Service_User')->isGuest()) {
            $this->gotoRouteAndExit(array(), 'login');
        }
        
        $this->_bookService = $this->getService('Book_Service_Book');
    }
    
    /**
     * Index page of logged-in user
     * 
     * Route: /book-admin
     */
    public function indexAction()
    {
        if (! $this->_bookService->checkAcl('manage')) {
            $this->gotoRouteAndExit(array(), 'login');
        }
        
        $reviews = $this->getService('Book_Service_Review')->getLatestReview();
        $this->view->reviews = $reviews;
    }
    
    /**
     * Action to insert new book
     * 
     * Route: /book-admin/insert
     */
    public function insertAction()
    {
        if (! $this->_bookService->checkAcl('manage')) {
            $this->gotoRouteAndExit(array(), 'login');
        }
        
        $request = $this->getRequest();
        $form = $this->_bookService->getForm();
        $this->view->bookForm = $form;
        
        if ($request->isPost() && $form->isValid($request->getPost())) {

        }
    }
    
    /**
     * Action to update single book. This will take id_book param 
     * from action param.
     * 
     * Route: /book-admin/update/:id_book
     */
    public function updateAction()
    {
        if (! $this->_bookService->checkAcl('manage')) {
            $this->gotoRouteAndExit(array(), 'login');
        }
        
        $request = $this->getRequest();
        $id_book = $request->getParam('id_book');
        $book = $this->_bookService->getBookByIdBook($id_book);
        $form = $this->_bookService->getForm();
        $form->inject($book);
        $this->view->bookForm = $form;
        
        if ($request->isPost() && $form->isValid($request->getPost())) {
            
        }
    }
    
    /**
     * Action to delete a book and all reviews. This will take id_book param 
     * from action param.
     * 
     * Route: /book-admin/delete/:id_book
     */
    public function deleteAction()
    {
        if (! $this->_bookService->checkAcl('manage')) {
            $this->gotoRouteAndExit(array(), 'login');
        }
        
    }
    
    /**
     * Action to clear/delete entire zend_cache_core query cache.
     * 
     * Route: /book-admin/flush-cache
     */
    public function flushcacheAction()
    {
        if (! $this->_bookService->checkAcl('flush-cache')) {
            $this->gotoRouteAndExit(array(), 'login');
        }
        
        $flushCache = $this->_bookService->flushAllCache();
            
        if ($flushCache) {
            $this->view->flushStatus = 'Entire cache has been flushed.';
        }
    }
}
