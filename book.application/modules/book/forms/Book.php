<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Book_Form_Book
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_Form_Book extends Core_Form_BaseForm
{
    public function init()
    {
        $this->setOptions(array(
            'method' => 'post',
            'elements' => array(
                'book_title' => array('text', array(
                    'label' => 'Book Title',
                    'required' => true,
                    'validators' => array(
                        array('StringLength', false, array('min' => 6, 'max' => 140))
                    ),
                    'attribs' => array(
                        'style' => 'width: 650px;'
                    ),
                    'description' => 'Required. Minimum 6 Chars, Maximum 140 Chars.',
                )),
                'book_abstract' => array('textarea', array(
                    'label' => 'Book Abstract',
                    'required' => true,
                    'validators' => array(
                        array('StringLength', false, array('min' => 6, 'max' => 500))
                    ),
                    'attribs' => array(
                        'rows' => '10',
                        'style' => 'border-radius: 5px; border: 1px solid #ddd; padding: 8px;'
                    ),
                    'description' => 'Required. Minimum 6 Chars, Maximum 500 Chars.',
                )),
                'id_author' => array('select', array(
                    'label' => 'Author',
                    'validators' => array(
                        'digits'
                    ),
                    'attribs' => array(
                        'style' => 'width: 300px;'
                    ),
                    'multiOptions' => $this->_getAllAuthor(),
                    'description' => 'Required. Choose one or create new one on textbox below.',
                )),
                'id_category' => array('select', array(
                    'label' => 'Category',
                    'validators' => array(
                        'digits'
                    ),
                    'attribs' => array(
                        'style' => 'width: 300px;'
                    ),
                    'multiOptions' => $this->_getAllCategory(),
                    'description' => 'Required. Choose one or create new one on textbox below.',
                )),
                'id_publisher' => array('select', array(
                    'label' => 'Publisher',
                    'validators' => array(
                        'digits'
                    ),
                    'attribs' => array(
                        'style' => 'width: 300px;'
                    ),
                    'multiOptions' => $this->_getAllPublisher(),
                    'description' => 'Required. Choose one or create new one on textbox below.',
                )),
                'isbn' => array('text', array(
                    'label' => 'ISBN',
                    'validators' => array(
                        array('StringLength', false, array('min' => 6, 'max' => 45))
                    ),
                    'attribs' => array(
                        'style' => 'width: 300px;'
                    ),
                    'description' => 'Optional. Fill this field with ISBN-10 format.',
                )),
                'cover_filepath' => array('text', array(
                    'label' => 'Cover Filepath',
                    'validators' => array(
                        array('StringLength', false, array('max' => 254))
                    ),
                    'attribs' => array(
                        'style' => 'width: 300px;'
                    ),
                    'description' => 'Optional. Paste here book\'s cover url, it will be displayed in 200px width.',
                )),
                'year_published' => array('text', array(
                    'label' => 'Year Published',
                    'attribs' => array(
                        'style' => 'width: 100px;'
                    ),
                    'description' => 'Optional. Write book\'s year published.',
                )),
                'submit' => array('submit', array(
                    'label' => 'Save'
                ))
            ),
        ));
    }
    
    /**
     * Inject form values for updating
     * 
     * @param Book_Model_Book $book 
     */
    public function inject(Book_Model_Book $book)
    {
        $this->setDefaults(array(
            'book_title' => $book->book_title,
            'book_abstract' => $book->book_abstract,
            'id_author' => $book->id_author,
            'id_category' => $book->id_category,
            'id_publisher' => $book->id_publisher,
            'year_published' => $book->year_published
        ));
        return $this;
    }
    
    /**
     * Get all author from Book_Model_Author
     * 
     * @return array Multioption values
     */
    protected function _getAllAuthor()
    {
        $result = Core_Service_Proxy::get('Book_Service_Book')->getAllAuthor();
        foreach ($result as $author) {
            $selectValue[$author->id_author] = $author->author_name;
        }
        return $selectValue;
    }
    
    /**
     * Get all category from Book_Model_Category
     * 
     * @return array Multioption values
     */
    protected function _getAllCategory()
    {
        $result = Core_Service_Proxy::get('Book_Service_Book')->getAllCategory();
        foreach ($result as $category) {
            $selectValue[$category->id_category] = $category->category_name;
        }
        return $selectValue;
    }
    
    /**
     * Get all publisher from Book_Model_Publisher
     * 
     * @return array Multioption values
     */
    protected function _getAllPublisher()
    {
        $result = Core_Service_Proxy::get('Book_Service_Book')->getAllPublisher();
        foreach ($result as $publisher) {
            $selectValue[$publisher->id_publisher] = $publisher->publisher_name;
        }
        return $selectValue;
    }
}
