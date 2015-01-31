<?php

class Application_Model_DbTable_Notificacao extends Zend_Db_Table_Abstract
{

    protected $_name = 'notificacao';
  public function ordemSaida($idordem)
    {
        $data = array('idordem' => $id);
        
       $this->insert($data);
    }
    
    public function listOrdemSaida($id)
    {
        return $this->_db->fetchRow("SELECT idordem FROM notificacao WHERE idordem =".$id);
    }
}

