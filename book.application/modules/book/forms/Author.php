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
class Book_Form_Author extends Core_Form_BaseForm
{
    public function init()
    {
        $this->setOptions(array(
            'elements' => array(
                'author_name' => array('text', array(
                    'label' => 'Author Name',
                    'required' => true,
                    
                )),
                'submit' => array('submit', array(
                    'label' => 'Save'
                )),
            )
        ));
    }
    
    public function inject(Book_Model_Author $author) 
    {
        $this->setDefaults(array(
            'author_name' => $author->author_name
        ));
        return this;
    }
}
