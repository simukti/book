<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Book_Model_Author
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_Model_Author extends Minilib_BooksAuthor
{
    /**
     * @see Doctrine_Record::save()
     * @param array $data
     * @return void
     */
    public function insertAuthor(array $data)
    {
        $this->author_name = $data['author_name'];
        $save = $this->save();
        return $save;
    }
    
    /**
     * Update author
     * 
     * @see Doctrine_Record::save()
     * @param Book_Model_Author $author
     * @param array $new_data New author name
     * @return void
     */
    public function updateAuthor(Book_Model_Author $author, array $new_data)
    {
        $author->author_name = $new_data['author_name'];
        $save = $author->save();
        return $save;
    }
    
    /**
     * This method will cascade delete entire connected data related to this $id_author
     * (all books written by this author, and all reviews for all of those books)
     * 
     * @see Minilib_Books
     * @param Book_Model_Author $author
     * @return boolean Deletion status
     */
    public function deleteAuthor(Book_Model_Author $author)
    {
        $delete = $author->delete();
        return $delete;
    }
    
    /**
     * Get single category
     * 
     * @param int $id_author
     * @return Doctrine_Record
     */
    public function getAuthor($id_author)
    {
        $author = $this->getTable()->findOneByIdBooksAuthor($id_author);
        return $author;
    }
    
    /**
     * Get all author from database
     * 
     * @return Doctrine_Collection
     */
    public function getAllAuthor()
    {
        $authors = $this->getTable()->createQuery('a')
                        ->orderBy('a.author_name')
                        ->execute();
        return $authors;
    }
}
