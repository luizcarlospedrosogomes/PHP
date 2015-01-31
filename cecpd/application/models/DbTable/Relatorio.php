<?php

class Application_Model_DbTable_Relatorio extends Zend_Db_Table_Abstract
{

    protected $_name = 'relatorio';

    public function contaEquip()
    {
        return $this->_db->fetchAll("SELECT COUNT(ordem.idequipamento) AS quantidade, equipamento.nome AS equipnome
                                    FROM ordem JOIN equipamento ON equipamento.id = ordem.idequipamento
                                    GROUP BY equipamento.id
                                    ORDER BY equipamento.nome ASC
                                    ");
    }
}

