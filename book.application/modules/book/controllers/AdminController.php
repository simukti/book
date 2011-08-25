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
     * Set main book servive and acl checking for this controller.
     */
    public function init()
    {
        $this->_bookService = $this->getService('Book_Service_Book');
        
        if (! $this->_bookService->checkAcl('manage')) {
            $this->gotoRouteAndExit(array(), 'login');
        }
    }
    
    /**
     * Index page of logged-in user
     * 
     * Route: /book-admin
     */
    public function indexAction()
    {}
    
    /**
     * Get latest reviews from all books
     */
    public function latestReviewAction()
    {
        $reviews = $this->getService('Book_Service_Review')->getLatestReview();
        $this->view->reviews = $reviews;
    }
    
    /**
     * Action to insert new book
     * 
     * Route: /book-admin/insert-book
     */
    public function insertAction()
    {
        $request = $this->getRequest();
        $form    = $this->_bookService->getForm();
        $this->view->bookForm = $form;
        
        if ($request->isPost() && $form->isValid($request->getPost())) {
            $insert = $this->_bookService->insert($form->getValues());
            if ($insert) {
                $this->gotoRouteAndExit(array(), 'book-admin');
            }
        }
    }
    
    /**
     * Action to update single book. This will take id_book param 
     * from action param.
     * 
     * Route: /book-admin/update-book/:id_book
     */
    public function updateAction()
    {
        $request = $this->getRequest();
        $id_book = $request->getParam('id_book');
        $book    = $this->_bookService->getBookByIdBook($id_book);
        
        if ($book) {
            $form = $this->_bookService->getForm();
            $form->inject($book);
            $this->view->bookForm = $form;
            if ($request->isPost() && $form->isValid($request->getPost())) {
                $update = $this->_bookService->update($book, $form->getValues());
                if ($update) {
                    $this->gotoRouteAndExit(array('id_book' => $id_book), 'book-view');
                }
            }
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
        $this->disableLayout();
        $this->disableView();
    }
    
    /**
     * Route: /book-admin/insert-author
     */
    public function insertAuthorAction()
    {
        $form    = $this->_bookService->getAuthorForm();
        $this->view->authorForm = $form;
        
        $request = $this->getRequest();
        
        if ($request->isPost() && $form->isValid($request->getPost())) {
            $insert = $this->_bookService->insertAuthor($form->getValues());
            if ($insert) {
                $this->gotoRouteAndExit(array(), 'book-insert-author');
            }
        }
        
        $this->render('author');
    }
    
    /**
     * Route: /book-admin/update-author/:id_author
     */
    public function updateAuthorAction()
    {
        $request    = $this->getRequest();
        $id_author  = $request->getParam('id_author');
        $author     = $this->_bookService->getAuthor($id_author);
        $form       = $this->_bookService->getAuthorForm();

        $form->inject($author);
        $this->view->authorForm = $form;
        
        if ($request->isPost() && $form->isValid($request->getPost())) {
            $update = $this->_bookService->updateAuthor($author, $form->getValues());
            if ($update) {
                $this->gotoRouteAndExit(array(), 'book-update-author');
            }
        }
        
        $this->render('author');
    }
    
    /**
     * Route: /book-admin/delete-author/:id_author
     */
    public function deleteAuthorAction()
    {
        $id_author  = $this->getRequest()->getParam('id_author');
        $delete     = $this->_bookService->deleteAuthor($id_author);
        
        if ($delete) {
            $this->gotoRouteAndExit(array(), 'book-insert-author');
        }
        
        $this->disableLayout();
        $this->disableView();
    }
    
    /**
     * Route: /book-admin/insert-category/:id_category
     */
    public function insertCategoryAction()
    {
        $form = $this->_bookService->getCategoryForm();
        $this->view->categoryForm = $form;
        
        $request = $this->getRequest();
        
        if ($request->isPost() && $form->isValid($request->getPost())) {
            $insert = $this->_bookService->insertCategory($form->getValues());
            if ($insert) {
                $this->gotoRouteAndExit(array(), 'book-insert-category');
            }
        }
        
        $this->render('category');
    }
    
    /**
     * Route: /book-admin/update-category/:id_category
     */
    public function updateCategoryAction()
    {
        $request     = $this->getRequest();
        $id_category = $request->getParam('id_category');
        $category    = $this->_bookService->getCategory($id_category);
        $form        = $this->_bookService->getCategoryForm();
        
        $form->inject($category);
        $this->view->categoryForm = $form;
        
        if ($request->isPost() && $form->isValid($request->getPost())) {
            $update = $this->_bookService->updateCategory($category, $form->getValues());
            if ($update) {
                $this->gotoRouteAndExit(array(), 'book-insert-category');
            }
        }
        
        $this->render('category');
    }
    
    /**
     * Route: /book-admin/delete-category/:id_category
     */
    public function deleteCategoryAction()
    {
        $request     = $this->getRequest();
        $id_category = $request->getParam('id_category');
        $delete      = $this->_bookService->deleteCategory($id_category);
        
        if ($delete) {
            $this->gotoRouteAndExit(array(), 'book-insert-category');
        }
        
        $this->disableLayout();
        $this->disableView();
    }
    
    /**
     * Route: /book-admin/insert-publisher
     */
    public function insertPublisherAction()
    {
        $form = $this->_bookService->getPublisherForm();
        $this->view->publisherForm = $form;
        
        $request = $this->getRequest();
        
        if ($request->isPost() && $form->isValid($request->getPost())) {
            $insert = $this->_bookService->insertPublisher($form->getValues());
            if ($insert) {
                $this->gotoRouteAndExit(array(), 'book-insert-publisher');
            }
        }
        
        $this->render('publisher');
    }
    
    /**
     * Route: /book-admin/update-publisher/:id_publisher
     */
    public function updatePublisherAction()
    {
        $request      = $this->getRequest();
        $id_publisher = $request->getParam('id_publisher');
        $publisher    = $this->_bookService->getPublisher($id_publisher);
        $form         = $this->_bookService->getPublisherForm();
        
        $form->inject($publisher);
        $this->view->publisherForm = $form;
        
        if ($request->isPost() && $form->isValid($request->getPost())) {
            $update = $this->_bookService->updatePublisher($publisher, $form->getValues());
            if ($update) {
                $this->gotoRouteAndExit(array(), 'book-insert-publisher');
            }
        }
        
        $this->render('publisher');
    }
    
    /**
     * Route: /book-admin/delete-publisher/:id_publisher
     */
    public function deletePublisherAction()
    {
        $request      = $this->getRequest();
        $id_publisher = $request->getParam('id_publisher');
        $delete       = $this->_bookService->deletePublisher($id_publisher);
        
        if ($delete) {
            $this->gotoRouteAndExit(array(), 'book-insert-publisher');
        }
        
        $this->disableLayout();
        $this->disableView();
    }
    
    /**
     * Action to clear/delete entire zend_cache_core query cache.
     * 
     * Route: /book-admin/flush-cache
     */
    public function flushcacheAction()
    {
        $flushCache = $this->_bookService->flushAllCache();
            
        if ($flushCache) {
            $this->view->flushStatus = 'Entire cache has been flushed.';
        } else {
            $this->view->flushStatus = 'Error.';
        }
    }
}
