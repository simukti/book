<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Book_IndexController
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_IndexController extends Core_Controller_Action
{
    /**
     * @var Book_Service_Book
     */
    protected $_book_service;
    
    /**
     * @see Zend_Controller_Action::init()
     */
    public function init()
    {
        $this->_book_service = $this->getService('Book_Service_Book');
    }
    
    /**
     * Display entire collection. 
     * 
     * Route: /
     */
    public function indexAction()
    {
        $books = $this->_book_service->getAllBooks();
        if (! $books) {
            $this->getResponse()->setHttpResponseCode(404);
            $this->render('404');
        }
        $this->view->books = $books;
    }
    
    /**
     * Filter books by id_author
     * 
     * Route: /author/:id_author
     */
    public function authorAction()
    {
        $request = $this->getRequest();
        $id_author = $request->getParam('id_author');
        $books = $this->_book_service->getBooksByIdBooksAuthor($id_author);
        if (! $books) {
            $this->getResponse()->setHttpResponseCode(404);
            $this->render('404');
        } else {
            $this->view->books = $books->Books;
            $this->view->message = 'Written by ' . $books->author_name;
            $this->render('index');
        }
    }
    
    /**
     * Filter books by id_category
     * 
     * Route: /category/:id_category
     */
    public function categoryAction()
    {
        $request = $this->getRequest();
        $id_category = $request->getParam('id_category');
        $books = $this->_book_service->getBooksByIdBooksCategory($id_category);
        if (! $books) {
            $this->getResponse()->setHttpResponseCode(404);
            $this->render('404');
        } else {
            $this->view->books = $books->Books;
            $this->view->message = 'Category ' . $books->category_name;
            $this->render('index');
        }
    }
    
    /**
     * Filter books by id_publisher
     * 
     * Route: /publisher/:id_publisher
     */
    public function publisherAction()
    {
        $request = $this->getRequest();
        $id_publisher = $request->getParam('id_publisher');
        $books = $this->_book_service->getBooksByIdBooksPublisher($id_publisher);
        if (! $books) {
            $this->getResponse()->setHttpResponseCode(404);
            $this->render('404');
        } else {
            $this->view->books = $books->Books;
            $this->view->message = 'Published by ' . $books->publisher_name;
            $this->render('index');
        }
    }
    
    /**
     * Display single book + review form. 
     * Render another view if id_book is not found.
     * 
     * Route: /book/:id_book
     */
    public function viewAction()
    {
        $request = $this->getRequest();
        $id_book = $request->getParam('id_book');
        $book = $this->_book_service->getBookByIdBook($id_book);
        if (! $book) {
            $this->getResponse()->setHttpResponseCode(404);
            $this->render('404');
        }
        
        $form = $this->getService('Book_Service_Review')->getForm();
        $user = $this->getService('User_Service_User');
        /* inject hidden element's value for logged-in user */
        if (! $user->isGuest()) {
            $form->injectUser($user->getCurrentUser());
        }
        $this->view->book = $book;
        $this->view->review_form = $form;
        
        if ($request->isPost() && $form->isValid($request->getPost())) {
            $insert = $this->getService('Book_Service_Review')->insert($id_book, $form->getValues());
            if ($insert) {
                $this->gotoRouteAndExit(array('id_book' => $id_book), 'book-view');
            }
        }
    }
    
    /**
     * Route: /search
     */
    public function searchAction()
    {}
}
