<?php
class Mongo_Teste{
	
	
		public  $conectar;
		public $db;
		//var   $listar;
		
	public function __construct()
	{
		$this->conectar = new Mongo();
		$this->db = $this->conectar->cecpd;
	}
	
	
	public function insereMongo($nome, $matricula, $setor, $email, $equipamento, $dataDevolucao,$obs)
	{
		//echo $dataDevolucao;
		$array = array('nome' => $nome, 			
						'matricula' => $matricula,	
						'setor' => $setor,
						'email' => $email,
						'equipamento' => $equipamento,
						'dataDevolucao' => strtotime($dataDevolucao.' 00:00:00'),
						'situacao' => 1,
						'obs' => $obs);
		$table =$this->db->pendencias;
		
		$table->insert($array);
				
	}
	
	public function listar()
	 {
		$liste = $this->db->pendencias->find();
		//foreach ($listar as $this->list)
		//var_dump($list);
		return $liste;
	}
	
	public function excluir($id)
	{
		
		$data = array('_id' => new MongoId($id));
		$table = $this->db->pendencias;
		//var_dump($id);
		$table->remove($data);
		
	}
	public function listarpendencias($id)
	{
		//echo $id;
		
		$table = $this->db->pendencias->findOne(array("_id"=> new MongoId($id)));
		//var_dump($table);
		return $table;
	}
	
	public  function updatependencias($id,$nome, $matricula, $setor, $email, $equipamento,$situacao, $dataDevolucao,$obs)
	{
		$data = array('matricula' => $matricula,
					'nome' => $nome,
					'setor' => $setor,
					'email' => $email,
					'equipamento' => $equipamento,
					'situacao' => $situacao,
					'dataDevolucao' => strtotime($dataDevolucao.' 00:00:00'),
					'obs' => $obs,
				);
		$table = $this->db->pendencias;
		$table->update(array('_id' => new MongoId($id)), $data);
		
	}
}