<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Book_Model_Review
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
    
    /**
     * Insert new review
     * 
     * @param Book_Model_Book $book
     * @param array $review_data
     * @return void
     */
    public function insertReview(Book_Model_Book $book, array $review_data)
    {
        $this->id_books = $book->id_books;
        $this->name     = $review_data['name'];
        $this->email    = $review_data['email'];
        $this->content  = $review_data['content'];
        $save = $this->save();
        return $save;
    }
    
    /**
     * Delete single review
     * 
     * @see Doctrine_Record::delete()
     * @param Book_Model_Review $review
     * @return boolean
     */
    public function deleteReview(Book_Model_Review $review)
    {
        $delete = $review->delete();
        return $delete;
    }
    
    /**
     * Get single review object 
     * 
     * @param int $id_review
     * @return Doctrine_Record
     */
    public function getReview($id_review)
    {
        $review = $this->getTable()->findOneByIdBooksReviews();
        return $review;
    }
    
    /**
     * Get 20 latest reviews from all books
     * 
     * @param int $limit
     * @return Doctrine_Collection
     */
    public function getLatestReviews($limit = 20)
    {
        $latest_reviews = $this->getTable()->createQuery('r')
                               ->orderBy('r.review_time DESC')
                               ->limit($limit)
                               ->execute();
        return $latest_reviews;
    }
}
