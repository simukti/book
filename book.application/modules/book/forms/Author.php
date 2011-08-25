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
                    'validators' => array(
                        array('StringLength', false, array('min' => 6, 'max' => 140))
                    ),
                    'attribs' => array(
                        'style' => 'width: 300px;'
                    ),
                    'description' => 'Required. Minimum 6 Chars, Maximum 140 Chars.',
                )),
                'submit' => array('submit', array(
                    'label' => 'Save'
                )),
            )
        ));
    }
    
    /**
     * Inject form default value for updating
     * 
     * @param Book_Model_Author $author
     * @return Book_Form_Author
     */
    public function inject(Book_Model_Author $author) 
    {
        $this->setDefaults(array(
            'author_name' => $author->author_name
        ));
        $this->getElement('author_name')->setLabel('Update Author Name');
        return $this;
    }
}
