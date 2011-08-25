<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Book Service
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_Service_Book extends Core_Service_ServiceAbstract
{
    /**
     * Book_Model_Author
     */
    const BOOK_MODEL        = 'Book_Model_Book';
    
    /**
     * Book_Model_Author
     */
    const AUTHOR_MODEL      = 'Book_Model_Author';
    
    /**
     * Book_Model_Category
     */
    const CATEGORY_MODEL    = 'Book_Model_Category';
    
    /**
     * Book_Model_Publisher
     */
    const PUBLISHER_MODEL   = 'Book_Model_Publisher';
    
    /**
     * Zend cache id salt
     */
    const CACHEID_SALT      = 'simukti.net';
    
    /**
     * Zend_Acl_Resource
     * 
     * @var string
     */
    protected $_resourceId = 'book';
    
    /**
     * @var Book_Model_Book
     */
    protected $_bookModel;
    
    /**
     * @var Book_Model_Author
     */
    protected $_authorModel;
    
    /**
     * @var Book_Model_Category
     */
    protected $_categoryModel;
    
    /**
     * @var Book_Model_Publisher
     */
    protected $_publisherModel;

    /**
     * @var Book_Form_Book
     */
    protected $_bookForm;
    
    /**
     * @var Book_Form_Author
     */
    protected $_authorForm;
    
    /**
     * @var Book_Form_Category
     */
    protected $_categoryForm;
    
    /**
     * @var Book_Form_Publisher
     */
    protected $_publisherForm;
    
    /**
     * Get main Book model
     * 
     * @return Book_Model_Book
     */
    public function getBookModel()
    {
        if (null === $this->_bookModel) {
            $this->_bookModel = $this->getModel(self::BOOK_MODEL);
        }
        
        return $this->_bookModel;
    }
    
    /**
     * Get author model instance
     * 
     * @return Book_Model_Author
     */
    public function getAuthorModel()
    {
        if (null === $this->_authorModel) {
            $this->_authorModel = $this->getModel(self::AUTHOR_MODEL);
        }
        
        return $this->_authorModel;
    }
    
    /**
     * Get category model instance
     * 
     * @return Book_Model_Category
     */
    public function getCategoryModel()
    {
        if (null === $this->_categoryModel) {
            $this->_categoryModel = $this->getModel(self::CATEGORY_MODEL);
        }
        
        return $this->_categoryModel;
    }
    
    /**
     * Get publisher model instance
     * 
     * @return Book_Model_Publisher
     */
    public function getPublisherModel()
    {
        if (null === $this->_publisherModel) {
            $this->_publisherModel = $this->getModel(self::PUBLISHER_MODEL);
        }
        
        return $this->_publisherModel;
    }
    
    /**
     * Insert single book
     * 
     * @param array $data   Data of a new book
     * @return boolean
     */
    public function insert(array $data)
    {
        try {
            $this->getBookModel()->insertBook($data);
            return true;
        } catch (Exception $exc) {
            return false;
        }
    }
    
    /**
     * Update single book
     * 
     * @param Book_Model_Book $book
     * @param array $new_data
     * @return boolean Update status
     */
    public function update(Book_Model_Book $book, array $new_data)
    {
        try {
            $this->getBookModel()->updateBook($book, $new_data);
            $this->getCache()->remove('book_' . md5($book->id_books));
            return true;
        } catch (Exception $exc) {
            return false;
        }
    }
    
    /**
     * Delete single book
     * 
     * @param integer $id_book
     * @return boolean Deletion status
     */
    public function delete($id_book)
    {
        $book = $this->getBookByIdBook($id_book);
        if ($book) {
            $delete = $this->getBookModel()->deleteBook($book);
            if ($delete) {
                $this->getCache()->remove('book_' . md5($id_book));
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * @see Book_Model_Author::getAuthor()
     * @param int $id_author
     * @return Doctrine_Record
     */
    public function getAuthor($id_author)
    {
        return $this->getAuthorModel()->getAuthor($id_author);
    }
    
    /**
     * @see Book_Model_Author::insertAuthor()
     * @param array $data
     * @return boolean
     */
    public function insertAuthor(array $data)
    {
        try {
            $this->getAuthorModel()->insertAuthor($data);
            return true;
        } catch (Exception $exc) {
            return false;
        }
    }
    
    /**
     * @see Book_Model_Author::updateAuthor()
     * @param Book_Model_Author $author
     * @param array $new_data
     * @return boolean
     */
    public function updateAuthor(Book_Model_Author $author, array $new_data)
    {
        try {
            $update = $this->getAuthorModel()->updateAuthor($author, $new_data);
            return $update;
        } catch (Exception $exc) {
            return false;
        }
    }
    
    /**
     * @see Book_Model_Author::deleteAuthor()
     * @param int $id_author
     * @return boolean
     */
    public function deleteAuthor($id_author)
    {
        $author = $this->getAuthor($id_author);
        
        if ($author) {
            $delete = $this->getAuthorModel()->deleteAuthor($author);
            return $delete;
        }
    }
    
    /**
     * @param int $id_category
     * @see Book_Model_Category::getCategory()
     */
    public function getCategory($id_category)
    {
        return $this->getCategoryModel()->getCategory($id_category);
    }
    
    /**
     * @param array $data
     * @see Book_Model_Category::insertCategory()
     */
    public function insertCategory(array $data)
    {
        try {
            $this->getCategoryModel()->insertCategory($data);
            return true;
        } catch (Exception $exc) {
            return false;
        }
    }
    
    /**
     * @see Book_Model_Category::updateCategory()
     * @param Book_Model_Category $category
     * @param array $new_data
     * @return boolean
     */
    public function updateCategory(Book_Model_Category $category, array $new_data)
    {
        try {
            $update = $this->getCategoryModel()->updateCategory($category, $new_data);
            return $update;
        } catch (Exception $exc) {
            return false;
        }
    }
    
    /**
     * @see Book_Model_Category::deleteCategory()
     * @param int $id_category
     * @return boolean true If succesful
     */
    public function deleteCategory($id_category)
    {
        $category = $this->getCategory($id_category);
        
        if ($category) {
            $delete = $this->getCategoryModel()->deleteCategory($category);
            return $delete;
        }
        return false;
    }
    
    /**
     * @see Book_Model_Publisher::getPublisher()
     * @param int $id_publisher
     * @return Doctrine_Record
     */
    public function getPublisher($id_publisher)
    {
        return $this->getPublisherModel()->getPublisher($id_publisher);
    }
    
    /**
     * @see Book_Model_Publisher::insertPublisher()
     * @param array $data
     * @return boolean insertation status
     */
    public function insertPublisher(array $data)
    {
        try {
            $this->getPublisherModel()->insertPublisher($data);
            return true;
        } catch (Exception $exc) {
            return false;
        }
    }
    
    /**
     * @see Book_Model_Publisher::updatePublisher()
     * @param Book_Model_Publisher $publisher
     * @param array $new_data
     * @return void|false
     */
    public function updatePublisher(Book_Model_Publisher $publisher, array $new_data)
    {
        try {
            $update = $this->getPublisherModel()->updatePublisher($publisher, $new_data);
            return $update;
        } catch (Exception $exc) {
            return false;
        }
    }
    
    /**
     * @see Book_Model_Publisher::deletePublisher()
     * @param int $id_publisher
     * @return boolean True if succesful
     */
    public function deletePublisher($id_publisher)
    {
        $publisher = $this->getPublisher($id_publisher);
        
        if ($publisher) {
            $delete = $this->getPublisherModel()->deletePublisher($publisher);
            return $delete;
        }
        return false;
    }
    
    /**
     * Get single book object and cache it
     * 
     * @param int $id_book
     * @return Book_Model_Book|false    
     */
    public function getBookByIdBook($id_book)
    {
        $cache = $this->getCache();
        
        if (null !== $cache) {
            $cacheId = 'book_' . md5($id_book);
            $book = $cache->load($cacheId);
        }
        
        if (! isset($book) || false === $book) {
            $book = $this->getBookModel()->getBook($id_book);
            if ($book) {
                if (null !== $cache) {
                    $cache->save($book, $cacheId);
                }
            } else {
                return false;
            }
        }
        
        return $book;
    }

    /**
     * Get all books within id category. This method used Doctrine_Filter
     * to get all books from Book_Model_Author via Doctrine_Relation.
     * 
     * @param int $id_author    id book author
     * @param bool $paginator   Prepare for pagination ?
     * @return Doctrine_Collection | Doctrine_Query
     */
    public function getBooksByIdBooksAuthor($id_author, $paginator = false)
    {
        $author_model = $this->getAuthorModel();
        
        if ($paginator) {
            $query = $author_model->getTable()->createQuery('b');
            return $query;
        }
        
        return $author_model->getAuthor($id_author);
    }
    
    /**
     * Get all books within id category. This method used Doctrine_Filter
     * to get all books from Book_Model_Category via Doctrine_Relation.
     * 
     * @param int  $id_category     Id category
     * @param bool $paginator       Prepare for pagination ?
     * @return Doctrine_Collection | Doctrine_Query
     */
    public function getBooksByIdBooksCategory($id_category, $paginator = false)
    {
        $category_model = $this->getCategoryModel();
        
        if ($paginator) {
            $query = $category_model->getTable()->createQuery('c');
            return $query;
        }
        
        return $category_model->getCategory($id_category);
    }
    
    /**
     * Get all books within ID publisher. This method used Doctrine_Filter
     * to get all books from Book_Model_Publisher via Doctrine_Relation.
     * 
     * @param int  $id_publisher    Id Publisher
     * @param bool $paginator       Prepare for pagination ?
     * @return Doctrine_Collection | Doctrine_Query
     */
    public function getBooksByIdBooksPublisher($id_publisher, $paginator = false)
    {
        $publisher_model = $this->getPublisherModel();
        
        if ($paginator) {
            $query = $publisher_model->getTable()->createQuery('p');
            return $query;
        }
        
        return $publisher_model->getPublisher($id_publisher);
    }
    
    /**
     * Get all books from Book_Model_Book
     * 
     * @param bool $paginator   Prepare for pagination ?
     * @return Doctrine_Collection | Doctrine_Query
     */
    public function getAllBooks($get_paging = false, $limit = 18)
    {
        $books = $this->getBookModel()->getAllBooks($get_paging, $limit);
        return $books;
    }
    
    /**
     * Get 10 latest books from Book_Model_Book (default is 10)
     * 
     * @param  int $limit    Record limit to fetch
     * @param  bool $cache   Cache result or not ?
     * @return Doctrine_Collection
     */
    public function getLatestBooks($limit = 10, $getcache = false)
    {
        $books = $this->getBookModel()->getLatestBook($limit);
        return $books;
    }
    
    /**
     * Get all book author from Book_Model_Author
     * 
     * @param  bool $cache   Cache result or not ?
     * @return Doctrine_Collection | false
     */
    public function getAllAuthor($getcache = false)
    {
        $cache = $this->getCache();
        
        if ($getcache && null !== $cache) {
            $cacheId = 'book_authors_' . md5(self::CACHEID_SALT);
            $authors = $cache->load($cacheId);
        }
        
        $author_model = $this->getAuthorModel();
        
        if (! isset($authors) || false === $authors) {
            $authors = $author_model->getAllAuthor();
            if (0 !== $authors->count()) {
                if ($getcache && null !== $cache) {
                    $cache->save($authors, $cacheId);
                }
            } else { /* this will create a default record if no author found */
                $author_model->insertAuthor(array('author_name' => 'Unknown'));
                $authors = $author_model->getAllAuthor();
            }
        }
        
        return $authors;
    }
    
    /**
     * Get all book category from Book_Model_Category
     * 
     * @param bool $getcache Cache result or not ?
     * @return Doctrine_Collection | false
     */
    public function getAllCategory($getcache = false)
    {
        $cache = $this->getCache();
        
        if ($getcache && null !== $cache) {
            $cacheId = 'book_categories_' . md5(self::CACHEID_SALT);
            $categories = $cache->load($cacheId);
        }
        
        $category_model = $this->getCategoryModel();
        
        if (! isset($categories) || false === $categories) {
            $categories = $category_model->getAllCategory();
            if (0 !== $categories->count()) {
                if ($getcache && null !== $cache) {
                    $cache->save($categories, $cacheId);
                }
            } else { /* this will create a default record if no category found */
                $category_model->insertCategory(array('category_name' => 'No Category'));
                $categories = $category_model->getAllCategory();
            }
        }
        
        return $categories;
    }
    
    /**
     * Get all book publisher from Book_Model_Publisher
     * 
     * @param bool $getcache Cache result or not ?
     * @return Doctrine_Collection | false
     */
    public function getAllPublisher($getcache = false)
    {
        $cache = $this->getCache();
        
        if ($getcache && null !== $cache) {
            $cacheId = 'book_publishers_' . md5(self::CACHEID_SALT);
            $publishers = $cache->load($cacheId);
        }
        
        $publisher_model = $this->getPublisherModel();
        
        if (! isset($publishers) || false === $publishers) {
            $publishers = $publisher_model->getAllPublisher();
            if (0 !== $publishers->count()) {
                if ($getcache && null !== $cache) {
                    $cache->save($publishers, $cacheId);
                }
            } else { /* this will create a default record if no publisher found */
                $publisher_model->insertPublisher(array('publisher_name' => 'Unknown'));
                $publishers = $publisher_model->getAllPublisher();
            }
        }
        
        return $publishers;
    }
    
    /**
     * Search books by title. This search is use Doctrine
     * 
     * @param string $title_keyword 
     */
    public function search($title_keyword)
    {}
    
    /**
     * Cache all book's query result from CACHE_PATH . DS . 'query'
     * 
     * @return bool True if entire cache has been flushed
     */
    public function flushAllCache()
    {
        try {
            $flushCache = $this->getCache()->clean();
            return $flushCache;
        } catch (Exception $exc) {
            return false;
        }
    }
    
    /**
     * Get book form for insert/update. 
     * Use Book_Form_Book::inject() to set form values for update.
     * 
     * @return Book_Form_Book 
     */
    public function getForm()
    {
        if (null === $this->_bookForm) {
            $this->_bookForm = new Book_Form_Book();
        }
        
        return $this->_bookForm;
    }
    
    /**
     * Get author form
     * 
     * @return Book_Form_Author
     */
    public function getAuthorForm()
    {
        if (null === $this->_authorForm) {
            $this->_authorForm = new Book_Form_Author();
        }
        
        return $this->_authorForm;
    }
    
    /**
     * Get category form
     * 
     * @return Book_Form_Category
     */
    public function getCategoryForm()
    {
        if (null === $this->_categoryForm) {
            $this->_categoryForm = new Book_Form_Category();
        }
        
        return $this->_categoryForm;
    }
    
    /**
     * Get publisher form
     * 
     * @return Book_Form_Publisher
     */
    public function getPublisherForm()
    {
        if (null === $this->_publisherForm) {
            $this->_publisherForm = new Book_Form_Publisher();
        }
        
        return $this->_publisherForm;
    }
    
    /**
     * Set access control list for this resource
     */
    protected function _setAcl()
    {
        $this->_acl->allow('admin', $this, 'manage');
    }
}
