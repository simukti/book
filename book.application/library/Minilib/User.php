<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Minilib_User', 'minilib');

/**
 * Minilib_User
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_user
 * @property string $uname
 * @property string $password
 * @property string $fullname
 * @property string $email
 * @property string $role
 * @property Doctrine_Collection $Books
 * 
 * @package    Minilib
 * @subpackage MainModel
 * @author     Sarjono Mukti Aji <simukti@facebook.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Minilib_User extends Core_Doctrine_RecordAbstract
{
    public function setTableDefinition()
    {
        $this->setTableName('user');
        $this->hasColumn('id_user', 'integer', 2, array(
             'type' => 'integer',
             'length' => 2,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('uname', 'string', 64, array(
             'type' => 'string',
             'length' => 64,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('password', 'string', 64, array(
             'type' => 'string',
             'length' => 64,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('fullname', 'string', 64, array(
             'type' => 'string',
             'length' => 64,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('email', 'string', 64, array(
             'type' => 'string',
             'length' => 64,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('role', 'string', 16, array(
             'type' => 'string',
             'length' => 16,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Minilib_Books as Books', array(
             'local' => 'id_user',
             'foreign' => 'id_user'));
    }
}