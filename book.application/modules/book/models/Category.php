<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Book_Model_Category
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_Model_Category extends Minilib_BooksCategory
{
    /**
     * @see Doctrine_Record::save()
     * @param array $data
     * @return void
     */
    public function insertCategory(array $data)
    {
        $this->category_name = $data['category_name'];
        $save = $this->save();
        return $save;
    }
    
    /**
     * @see Doctrine_Record::save()
     * @param Book_Model_Category $category
     * @param array $new_data
     * @return void
     */
    public function updateCategory(Book_Model_Category $category, array $new_data)
    {
        $category->category_name = $new_data['category_name'];
        $save = $category->save();
        return $save;
    }
    
    /**
     * This method will cascade delete all related data. 
     * 
     * @see Minilib_Books::delete()
     * @param Book_Model_Category $category
     * @return bool Deletion status
     */
    public function deleteCategory(Book_Model_Category $category)
    {
        $delete = $category->delete();
        return $delete;
    }
    
    /**
     * Get single category
     * 
     * @param int $id_category
     * @return Doctrine_Record | false
     */
    public function getCategory($id_category)
    {
        $category = $this->getTable()->findOneByIdBooksCategory($id_category);
        return $category;
    }
    
    /**
     * Get all category from database
     * 
     * @return Doctrine_Collection
     */
    public function getAllCategory()
    {
        $categories = $this->getTable()->createQuery('c')
                           ->orderBy('c.category_name')
                           ->execute();
        return $categories;
    }
}
