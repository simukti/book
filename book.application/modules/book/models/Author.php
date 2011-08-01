<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Author
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_Model_Author extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('books_author');
        $this->hasColumn('id_author', 'integer', 10, array(
            'type' => 'integer', 
            'length' => 10, 
            'primary' => true, 
            'autoincrement' => true,
            'unsigned' => true
        ));
        $this->hasColumn('author_name', 'string', 50, array(
            'type' => 'string', 
            'length' => 50,
            'notnull' => true,
        ));
    }
    
    public function setUp()
    {
        /* One-to-Many relationship */
        $this->hasMany('Book_Model_Book as Books', array(
            'local' => 'id_author',
            'foreign' => 'id_author'
        ));
    }
}
