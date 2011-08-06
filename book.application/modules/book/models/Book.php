<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Book_Model_Book
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_Model_Book extends Minilib_Books
{
    public function setUp()
    {
        parent::setUp();
        $this->unshiftFilter(new Doctrine_Record_Filter_Compound(array('BooksAuthor')));
        $this->unshiftFilter(new Doctrine_Record_Filter_Compound(array('BooksCategory')));
        $this->unshiftFilter(new Doctrine_Record_Filter_Compound(array('BooksPublisher')));
    }
    
    /**
     * Insert new book
     * 
     * @param array $data
     * @return void
     */
    public function insertBook(array $data)
    {
        $cover = (! empty($data['cover_filepath'])) ? $data['cover_filepath'] : null;
        $this->book_title          = $data['book_title'];
        $this->book_abstract       = $data['book_abstract'];
        $this->id_books_author     = $data['id_books_author'];
        $this->id_books_category   = $data['id_books_category'];
        $this->id_books_publisher  = $data['id_books_publisher'];
        $this->isbn                = $data['isbn'];
        $this->cover_filepath      = $cover;
        $this->year_published      = $data['year_published'];
        $this->id_user             = $this->getService('User_Service_User')->getCurrentUser()->id_user;
        $save = $this->save();
        return $save;
    }
    
    /**
     * Update single book
     * 
     * @param Book_Model_Book $book
     * @param array $new_data
     * @return void
     */
    public function updateBook(Book_Model_Book $book, array $new_data)
    {
        $cover = (! empty($new_data['cover_filepath'])) ? $new_data['cover_filepath'] : null;
        
        $book->book_title           = $new_data['book_title'];
        $book->book_abstract        = $new_data['book_abstract'];
        $book->id_books_author      = $new_data['id_books_author'];
        $book->id_books_category    = $new_data['id_books_category'];
        $book->id_books_publisher   = $new_data['id_books_publisher'];
        $book->isbn                 = $new_data['isbn'];
        $book->cover_filepath       = $cover;
        $book->year_published       = $new_data['year_published'];
        $save = $book->save();
        return $save;
    }
    
    /**
     * Delete single book
     * 
     * @param Book_Model_Book $book
     * @return boolean True if book is deleted
     * @todo check if this will delete all reviews related to this book
     */
    public function deleteBook(Book_Model_Book $book)
    {
        $delete = $book->delete();
        return $delete;
    }
    
    public function getAllBooks()
    {}
    
    protected function _getTitleSlug($title)
    {
        
    }
}
