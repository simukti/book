<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Minilib_Books', 'minilib');

/**
 * Minilib_Books
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_books
 * @property integer $id_books_author
 * @property integer $id_books_category
 * @property integer $id_books_publisher
 * @property string $book_title
 * @property string $book_abstract
 * @property string $isbn
 * @property integer $year_published
 * @property timestamp $date_added
 * @property string $cover_filepath
 * @property integer $id_user
 * @property Minilib_BooksAuthor $BooksAuthor
 * @property Minilib_BooksPublisher $BooksPublisher
 * @property Minilib_BooksCategory $BooksCategory
 * @property Minilib_User $User
 * @property Doctrine_Collection $BooksReview
 * 
 * @package    Minilib
 * @subpackage MainModel
 * @author     Sarjono Mukti Aji <simukti@facebook.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Minilib_Books extends Core_Doctrine_RecordAbstract
{
    public function setTableDefinition()
    {
        $this->setTableName('books');
        $this->hasColumn('id_books', 'integer', 8, array(
             'type' => 'integer',
             'length' => 8,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('id_books_author', 'integer', 3, array(
             'type' => 'integer',
             'length' => 3,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('id_books_category', 'integer', 3, array(
             'type' => 'integer',
             'length' => 3,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('id_books_publisher', 'integer', 3, array(
             'type' => 'integer',
             'length' => 3,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('book_title', 'string', 140, array(
             'type' => 'string',
             'length' => 140,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('book_abstract', 'string', 1500, array(
             'type' => 'string',
             'length' => 1500,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('isbn', 'string', 64, array(
             'type' => 'string',
             'length' => 64,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => 'N/A',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('year_published', 'integer', null, array(
             'type' => 'integer',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('date_added', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('cover_filepath', 'string', 254, array(
             'type' => 'string',
             'length' => 254,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '/assets/cover/no_cover.jpg',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('id_user', 'integer', 2, array(
             'type' => 'integer',
             'length' => 2,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Minilib_BooksAuthor as BooksAuthor', array(
             'local' => 'id_books_author',
             'foreign' => 'id_books_author'));

        $this->hasOne('Minilib_BooksPublisher as BooksPublisher', array(
             'local' => 'id_books_publisher',
             'foreign' => 'id_books_publisher'));

        $this->hasOne('Minilib_BooksCategory as BooksCategory', array(
             'local' => 'id_books_category',
             'foreign' => 'id_books_category'));

        $this->hasOne('Minilib_User as User', array(
             'local' => 'id_user',
             'foreign' => 'id_user'));

        $this->hasMany('Minilib_BooksReview as BooksReview', array(
             'local' => 'id_books',
             'foreign' => 'id_books'));
    }
}