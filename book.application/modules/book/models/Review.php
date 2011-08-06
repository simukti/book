<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Review
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_Model_Review extends Minilib_BooksReview
{
    public function setUp()
    {
        parent::setUp();
        $this->unshiftFilter(new Doctrine_Record_Filter_Compound(array('Books')));
    }
    
    public function insertReview($id_book, array $data)
    {
        $this->id_books = $id_book;
        $this->name     = $data['name'];
        $this->email    = $data['email'];
        $this->content  = $data['content'];
        $save = $this->save();
        return $save;
    }
    
    public function deleteReview(Book_Model_Review $review)
    {}
}
