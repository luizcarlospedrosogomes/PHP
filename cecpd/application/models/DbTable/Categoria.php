<?php

class Application_Model_DbTable_Categoria extends Zend_Db_Table_Abstract
{

    protected $_name = 'categoria';
public function cadCat($cat)
    {
        //var_dump($cat);
        $data = array ('nome'=>$cat);
        //$collection = $this->db->cat;
        
        $this->insert($data);
    }
    
    public function listaCat()
    {
         return $categoria = $this->_db->fetchAll('SELECT * FROM categoria ORDER BY nome');
    }
    

}

