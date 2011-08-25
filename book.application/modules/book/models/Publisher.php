<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Book_Model_Publisher
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_Model_Publisher extends Minilib_BooksPublisher
{
    /**
     * @see Doctrine_Record::save()
     * @param array $data
     * @return void
     */
    public function insertPublisher(array $data)
    {
        $this->publisher_name = $data['publisher_name'];
        $save = $this->save();
        return $save;
    }
    
    /**
     * @see Doctrine_Record::save()
     * @param Book_Model_Publisher $publisher
     * @param array $new_data
     * @return void
     */
    public function updatePublisher(Book_Model_Publisher $publisher, array $new_data)
    {
        $publisher->publisher_name = $new_data['publisher_name'];
        $save = $publisher->save();
        return $save;
    }
    
    /**
     * This method will cascade delete all related data. 
     * 
     * @see Minilib_Books
     * @param Book_Model_Publisher $publisher
     * @return boolen Deletion status
     */
    public function deletePublisher(Book_Model_Publisher $publisher)
    {
        $delete = $publisher->delete();
        return $delete;
    }
    
    /**
     * Get single publisher
     * 
     * @param type $id_publisher
     * @return Doctrine_Record
     */
    public function getPublisher($id_publisher)
    {
        $publisher = $this->getTable()->findOneByIdBooksPublisher($id_publisher);
        return $publisher;
    }
    
    /**
     * Get all publisher from database
     * 
     * @return Doctrine_Collection
     */
    public function getAllPublisher()
    {
        $publishers = $this->getTable()->createQuery('p')
                           ->orderBy('p.publisher_name')
                           ->execute();                
        return $publishers;
    }
}
