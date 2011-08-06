<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Review service
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_Service_Review extends Core_Service_ServiceAbstract
{
    /**
     * Book_Model_Review
     */
    const REVIEW_MODEL = 'Book_Model_Review';
    
    /**
     * Zend_Acl_Resource
     * 
     * @var string
     */
    protected $_resourceId = 'review';
    
    /**
     * @var Book_Model_Review
     */
    protected $_reviewModel;
    
    /**
     * Review form
     *  
     * @var Book_Form_Review
     */
    protected $_reviewForm;
    
    public function getReviewModel()
    {
        if (null === $this->_reviewModel) {
            $this->_reviewModel = $this->getModel(self::REVIEW_MODEL);
        }
        return $this->_reviewModel;
    }
    
    /**
     * Get 20 latest reviews from Book_Model_Review
     * 
     * @return Doctrine_Collection
     */
    public function getLatestReview()
    {
        $reviews = Doctrine_Core::getTable('Book_Model_Review')
                    ->createQuery()->limit(20)->execute();
        return $reviews;
    }
    
    public function insert($id_book, array $data)
    {
        try {
            $this->getReviewModel()->insertReview($id_book, $data);
            return true;
        } catch (Exception $exc) {
            return false;
        }
    }
    
    public function delete($id_review)
    {}
    
    /**
     * Get Review Form in a single book display
     * 
     * @return Book_Form_Review 
     */
    public function getForm()
    {
        if (null === $this->_reviewForm) {
            $this->_reviewForm = new Book_Form_Review();
        }
        return $this->_reviewForm;
    }
    
    protected function _setAcl()
    {
        $this->_acl->allow('admin', $this, 'delete');
    }
}
