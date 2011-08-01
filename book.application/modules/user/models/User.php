<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * User
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class User_Model_User extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('user');
        $this->hasColumn('id_user', 'integer', 10, array(
            'type' => 'integer', 
            'length' => 10, 
            'primary' => true, 
            'autoincrement' => true,
            'unsigned' => true,
            'notNull' => true
        ));
        $this->hasColumn('uname', 'string', 12, array(
            'type' => 'string', 
            'length' => 12, 
            'notNull' => true
        ));
        $this->hasColumn('passwd', 'string', 64, array(
            'type' => 'string', 
            'length' => 64, 
            'notNull' => true
        ));
        $this->hasColumn('fullname', 'string', 30, array(
            'type' => 'string', 
            'length' => 30, 
            'notNull' => true
        ));
        $this->hasColumn('email', 'string', 30, array(
            'type' => 'string', 
            'length' => 30, 
            'notNull' => true
        ));
        $this->hasColumn('role', 'string', 16, array(
            'type' => 'string', 
            'length' => 16, 
            'notNull' => true
        ));
    }
}
