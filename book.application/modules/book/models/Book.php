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
     * Only logged-in user able to exec this method, because it will take id_user
     * 
     * @see Doctrine_Record::save()
     * @see Book_Service_Book::_setAcl()
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
     * @see Doctrine_Record::save()
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
    
    /**
     * Get single book
     * 
     * @param int $id_book
     * @return Doctrine_Record
     */
    public function getBook($id_book)
    {
        $book = $this->getTable()->findOneByIdBooks($id_book);
        return $book;
    }
    
    /**
     * Get all books as a collection or a paginator object (Doctrine_Query)
     * 
     * @param boolean $get_paging
     * @param int     $limit
     * @return Doctrine_Query | Doctrine_Collection
     */
    public function getAllBooks($get_paging = false, $limit = 18)
    {
        $query = $this->getTable()->createQuery('b')
                      ->orderBy('b.book_title');
        if ($get_paging) {
            return $query;
        } else {
            $collection = $query->limit($limit)->execute();
            return $collection;
        }
    }
    
    /**
     * Get latest books. Default is 12 latest books
     * 
     * @param int $limit
     * @return Doctrine_Collection
     */
    public function getLatestBook($limit = 10)
    {
        $books = $this->getTable()->createQuery('b')
                      ->orderBy('b.date_added DESC')
                      ->limit($limit)
                      ->execute();
        return $books;
    }
}
