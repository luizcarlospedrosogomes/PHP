<?php

class Application_Model_DbTable_Filial extends Zend_Db_Table_Abstract
{

    protected $_name = 'filial';

 public function cadFilial($nome, $num)
    {
        $data = array ('nome' => $nome, 'numero' => $num);
        $this->insert($data);
        
        //$collection->insert($data);
    }
    public function listFilial()
    {
        
        return $filiais = $this->_db->fetchAll('SELECT * FROM filial ORDER BY numero ASC');
          
    }
    public function excluirFilial($id)
    {
         $where = $this->getAdapter()->quoteInto('id = ?', $id);
    	$this->delete($where);
    }
}

