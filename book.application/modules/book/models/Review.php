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
class Book_Model_Review extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('books_review');
        $this->hasColumn('id_books_review', 'integer', 10, array(
            'type' => 'integer', 
            'length' => 10, 
            'primary' => true,
            'autoincrement' => true,
            'unsigned' => true,
            'notnull' => true,
        ));
        $this->hasColumn('id_book', 'integer', 10, array(
            'type' => 'integer', 
            'length' => 10,
            'unsigned' => true,
            'notnull' => true,
        ));
        $this->hasColumn('name', 'string', 50, array(
            'type' => 'string', 
            'length' => 50,
            'notnull' => true,
        ));
        $this->hasColumn('email', 'string', 25, array(
            'type' => 'string', 
            'length' => 25,
            'notnull' => true,
        ));
        $this->hasColumn('review_content', 'string', 768, array(
            'type' => 'string', 
            'length' => 768,
            'notnull' => true,
        ));
    }
    
    public function setUp()
    {
        /* One-to-One relationship */
        $this->hasOne('Book_Model_Book as Book', array(
            'local' => 'id_book',
            'foreign' => 'id_book'
        ));
        $this->unshiftFilter(new Doctrine_Record_Filter_Compound(array('Book')));
    }
}
