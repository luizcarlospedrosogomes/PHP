<?php

class Application_Model_DbTable_Pendencias extends Zend_Db_Table_Abstract
{

    protected $_name = 'pendencias';

	public function gerarPendecia($nome, $matricula, $setor, $email, $equipamento, $dataDevolucao,$obs)
	{
		//echo $dataDevolucao;
		$array = array('nome' => $nome, 			
						'matricula' => $matricula,	
						'setor' => $setor,
						'email' => $email,
						'equipamento' => $equipamento,
						'datadevolucao' => strtotime($dataDevolucao.' 00:00:00'),
						'situacao' => 1,
						'obs' => $obs);
		
		
		$this->insert($array);
				
	}
	
	public function listar()
	 {
            return $this->_db->fetchAll('SELECT * FROM pendencias');
	}
	
	public function excluir($id)
	{

        $where = $this->getAdapter()->quoteInto('id = ?', $id);
    	$this->delete($where);
   
		
	}
	public function listarpendencias($id)
	{
            return  $this->_db->fetchRow("SELECT * FROM pendencias WHERE id =".$id);
		
	}
	
	public  function updatependencias($id,$nome, $matricula, $setor, $email, $equipamento,$situacao, $dataDevolucao,$obs)
	{
		$data = array('matricula' => $matricula,
					'nome' => $nome,
					'setor' => $setor,
					'email' => $email,
					'equipamento' => $equipamento,
					'situacao' => $situacao,
					'datadevolucao' => strtotime($dataDevolucao.' 00:00:00'),
					'obs' => $obs,
                                        );
                                        $this->update($data, 'id='.$id);
		
	}

}

