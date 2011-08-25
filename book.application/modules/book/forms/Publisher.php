<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Publisher
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_Form_Publisher extends Core_Form_BaseForm
{
    public function init()
    {
        $this->setOptions(array(
            'elements' => array(
                'publisher_name' => array('text', array(
                    'label' => 'Publisher Name',
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
    
    public function inject(Book_Model_Publisher $publisher)
    {
        $this->setDefaults(array(
            'publisher_name' => $publisher->publisher_name
        ));
        return $this;
    }
}
