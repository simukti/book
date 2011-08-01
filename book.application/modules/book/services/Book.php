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
     * Zend_Acl_Resource
     * 
     * @var string
     */
    protected $_resourceId = 'book';
    
    /**
     * Primary book form
     * 
     * @var Book_Form_Book
     */
    protected $_bookForm;
    
    /**
     * Empty constructor
     */
    public function __construct()
    {}
    
    public function insert(array $data)
    {}
    
    public function delete($id_book)
    {}
    
    public function update($id_book, array $data)
    {}
    
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
            $book = Doctrine_Core::getTable('Book_Model_Book')
                                 ->findOneByIdBook($id_book);
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
    public function getBooksByIdAuthor($id_author, $paginator = false)
    {
        $books = Doctrine_Core::getTable('Book_Model_Author');
        if ($paginator) {
            $query = $books->createQuery();
            return $query;
        }
        return $books->findOneByIdAuthor($id_author);
    }
    
    /**
     * Get all books within id category. This method used Doctrine_Filter
     * to get all books from Book_Model_Category via Doctrine_Relation.
     * 
     * @param int  $id_category     Id category
     * @param bool $paginator       Prepare for pagination ?
     * @return Doctrine_Collection | Doctrine_Query
     */
    public function getBooksByIdCategory($id_category, $paginator = false)
    {
        $books = Doctrine_Core::getTable('Book_Model_Category');
        if ($paginator) {
            $query = $books->createQuery();
            return $query;
        }
        return $books->findOneByIdCategory($id_category);
    }
    
    /**
     * Get all books within ID publisher. This method used Doctrine_Filter
     * to get all books from Book_Model_Publisher via Doctrine_Relation.
     * 
     * @param int  $id_publisher    Id Publisher
     * @param bool $paginator       Prepare for pagination ?
     * @return Doctrine_Collection | Doctrine_Query
     */
    public function getBooksByIdPublisher($id_publisher, $paginator = false)
    {
        $books = Doctrine_Core::getTable('Book_Model_Publisher');
        if ($paginator) {
            $query = $books->createQuery();
            return $query;
        }
        return $books->findOneByIdPublisher($id_publisher);
    }
    
    /**
     * Get all books from Book_Model_Book
     * 
     * @param bool $paginator   Prepare for pagination ?
     * @return Doctrine_Collection | Doctrine_Query
     */
    public function getAllBooks($paginator = false)
    {
        $books = Doctrine_Core::getTable('Book_Model_Book');
        if ($paginator) {
            $query = $books->createQuery();
            return $query;
        }
        return $books->findAll();
    }
    
    /**
     * Get 10 latest books from Book_Model_Book (default is 10)
     * 
     * @param  int $limit    Record limit to fetch
     * @param  bool $cache   Cache result or not ?
     * @return Doctrine_Collection
     */
    public function getLatestBooks($limit = 10, $cache = false)
    {
        $query = Doctrine_Query::create()->select()
                    ->from('Book_Model_Book b')
                    ->orderBy('b.date_added DESC')->limit($limit);
        $books = $query->execute();
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
            $cacheId = 'book_authors_' . md5('book.simukti.net');
            $authors = $cache->load($cacheId);
        }
        
        if (! isset($authors) || false === $authors) {
            $query = Doctrine_Query::create()->select()
                        ->from('Book_Model_Author a')
                        ->orderBy('a.author_name');
            $authors = $query->execute();
            if ($authors) {
                if ($getcache && null !== $cache) {
                    $cache->save($authors, $cacheId);
                } else {
                    return $authors;
                }
            } else {
                return false;
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
            $cacheId = 'book_categories_' . md5('book.simukti.net');
            $categories = $cache->load($cacheId);
        }
        
        if (! isset($categories) || false === $categories) {
            $query = Doctrine_Query::create()->select()
                        ->from('Book_Model_Category c')
                        ->orderBy('c.category_name');
            $categories = $query->execute();
            if ($categories) {
                if ($getcache && null !== $cache) {
                    $cache->save($categories, $cacheId);
                } else {
                    return $categories;
                }
            } else {
                return false;
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
            $cacheId = 'book_publishers_' . md5('book.simukti.net');
            $publishers = $cache->load($cacheId);
        }
        
        if (! isset($publishers) || false === $publishers) {
            $query = Doctrine_Query::create()->select()
                        ->from('Book_Model_Publisher p')
                        ->orderBy('p.publisher_name');
            $publishers = $query->execute();
            if ($publishers) {
                if ($getcache && null !== $cache) {
                    $cache->save($publishers, $cacheId);
                } else {
                    return $publishers;
                }
            } else {
                return false;
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
        $cache = $this->getCache();
        $flushCache = $cache->clean();
        return $flushCache;
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
     * Set access control list for this resource
     */
    protected function _setAcl()
    {
        $this->_acl->allow('admin', $this, 'flush-cache');
        $this->_acl->allow('admin', $this, 'manage');
    }
}
