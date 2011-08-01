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
class Book_Model_Book extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('books');
        
        $this->hasColumn('id_book', 'integer', 10, array(
            'type' => 'integer', 
            'length' => 10, 
            'primary' => true, 
            'autoincrement' => true,
            'unsigned' => true
        ));
        
        $this->hasColumn('book_title', 'string', 140, array(
            'type' => 'string', 
            'length' => 140,
            'notnull' => true,
        ));
        
        $this->hasColumn('book_abstract', 'string', 500, array(
            'type' => 'string', 
            'length' => 500,
        ));
        
        $this->hasColumn('isbn', 'string', 45, array(
            'type' => 'string', 
            'length' => 45,
        ));
        
        $this->hasColumn('year_published', 'string', 4, array(
            'type' => 'string', 
            'length' => 140,
            'notnull' => true,
        ));
        
        $this->hasColumn('date_added', 'date', array(
            'notnull' => true,
        ));
        
        $this->hasColumn('cover_filepath', 'string', 254);
        
        $this->hasColumn('id_author', 'integer', 10, array(
            'notnull' => true,
        ));
        
        $this->hasColumn('id_category', 'integer', 10, array(
            'notnull' => true,
        ));
        
        $this->hasColumn('id_publisher', 'integer', 10, array(
            'notnull' => true,
        ));
    }
    
    public function setUp()
    {
        /* One-to-One relationship */
        $this->hasOne('Book_Model_Author as Author', array(
            'local' => 'id_author',
            'foreign' => 'id_author'
        ));
        $this->unshiftFilter(new Doctrine_Record_Filter_Compound(array('Author')));
        
        /* One-to-One relationship */
        $this->hasOne('Book_Model_Category as Category', array(
            'local' => 'id_category',
            'foreign' => 'id_category'
        ));
        $this->unshiftFilter(new Doctrine_Record_Filter_Compound(array('Category')));
        
        /* One-to-One relationship */
        $this->hasOne('Book_Model_Publisher as Publisher', array(
            'local' => 'id_publisher',
            'foreign' => 'id_publisher'
        ));
        $this->unshiftFilter(new Doctrine_Record_Filter_Compound(array('Publisher')));
        
        /* One-to-Many relationship */
        $this->hasMany('Book_Model_Review as Reviews', array(
            'local' => 'id_book',
            'foreign' => 'id_book'
        ));
    }
}
