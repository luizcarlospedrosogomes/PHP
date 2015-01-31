<?php

class Application_Model_DbTable_Equipamento extends Zend_Db_Table_Abstract
{

    protected $_name = 'equipamento';

 public function cadEquip($nome, $cat, $qtd,$nf,$forn, $valor, $date, $marca)
    { 
        $data = array('idcategoria' => $cat, 'idfornecedor' => $forn, 'nome' => $nome, 'marca' => $marca,'quantidade' => $qtd, 'valor' => $valor, 'dataentrada' => $date );
        
        $this->insert($data);
    }
    
     public function listaEquip()
    {
         return $this->_db->fetchAll('SELECT equipamento.id as idequip, categoria.nome as catnome, equipamento.nome as equipnome, fornecedor.nome as fornnome
                                    FROM equipamento  JOIN categoria  ON categoria.id = equipamento.idcategoria
                                    JOIN fornecedor ON fornecedor.id = equipamento.idfornecedor
                                    ORDER BY equipamento.nome,categoria.nome');
    }
    
    public function listarEquipTotal()
    {
        return $this->_db->fetchAll('SELECT * FROM equipamento ORDER BY nome ASC');
    }

        public function excluirEquip($id)
    {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
    	$this->delete($where);
    }
 
    
           
}

