<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Category
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_Form_Category extends Core_Form_BaseForm
{
    public function init()
    {
        $this->setOptions(array(
            'elements' => array(
                'category_name' => array('text', array(
                    'label' => 'Category Name',
                    'required' => true,
                    'validators' => array(
                        array('StringLength', false, array('min' => 3, 'max' => 140))
                    ),
                    'attribs' => array(
                        'style' => 'width: 300px;'
                    ),
                    'description' => 'Required. Minimum 3 Chars, Maximum 140 Chars.',
                )),
                'submit' => array('submit', array(
                    'label' => 'Save'
                )),
            )
        ));
    }
    
    public function inject(Book_Model_Category $category)
    {
        $this->setDefaults(array(
            'category_name' => $category->category_name
        ));
        return $this;
    }
}
