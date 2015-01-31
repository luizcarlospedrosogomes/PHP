<?php

class Application_Model_DbTable_Fornecedor extends Zend_Db_Table_Abstract
{

    protected $_name = 'fornecedor';
public function cadForn($cnpj, $nome, $endereco)
    {
        $data = array('cnpj' => $cnpj, 'nome' => $nome, 'cidade' => $endereco);
              
        $this->insert($data);
    }
    
    public function listaForn()
    {
        return $this->_db->fetchAll('SELECT * FROM fornecedor');
    }
    
    public function excluirForn($id)
    {
       $where = $this->getAdapter()->quoteInto('id = ?', $id);
    	$this->delete($where);
    }
    
    

}

