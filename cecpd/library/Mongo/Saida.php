<?php
class Mongo_Saida
{
    public $conectar;
    public $db;
   // public $collection;
    
    public function __construct()
    {
		$this->conectar = new Mongo();
		$this->db = $this->conectar-> cecpd;
    }
    public function registraOS($filial, $equipamento, $marca, $obs, $usuario, $centroDeCusto,$quantidade)
    {
       $equip = $this->db->equipamento->findOne(array("_id"=> new MongoId($equipamento)));
       $situacao = 1;
        $data = array(
                'filial' => $filial,
                'centroDeCusto' => $centroDeCusto,
                'equipamento' => $equip['nome'],
                'idEquipamento' =>$equip['_id'],
                'marca' => $marca,
                'quantidade'=>(int)$quantidade,
                'situacao' => $situacao,
                'obs' => $obs,
                'usuario' => $usuario,
                'dataCriacao' => strtotime(date('d-m-Y')),
        );
        
        $collection = $this->db->ordem;
        
        $collection->insert($data);
    }
    
    public function listaOrdem()
    {
        
       return $this->db->ordem->find();
                
    }
    
    public function excluir($id)
    {
       $data = array('_id' => new MongoId($id));
	$colletion = $this->db->ordem;
		//var_dump($id);
	$colletion->remove($data); 
    }
    
    public function listarOrdem($id)
    {
        $collection = $this->db->ordem->findOne(array("_id"=> new MongoId($id)));
        
        return $collection;
    }
     public function listarEnviados($situacao)
    {
           return $this->db->ordem->find(array("situacao"=> $situacao))->sort(array("dataCriacao"=> 1,"filial" => 1));
          // $cursor);
      
    }
    public function updateOrdem($id, $filial, $equipamento, $marca, $situacao, $usuario, $obs, $dataCriacao,$centroDeCusto,$quantidade)
    {
        $data = array(
                'filial' => $filial,
                'centroDeCusto' => $centroDeCusto,
                'equipamento' => $equipamento,
                'marca' => $marca,
                'quantidade'=>(int)$quantidade,
                'situacao' => $situacao,
                'usuario' => $usuario,
                'dataDeEdicao' => strtotime(date('d-m-Y')),
                'dataCriacao' => $dataCriacao,
                'obs' => $obs,
            
        );
        
        $colletcion = $this->db->ordem;
        
        $colletcion->update(array('_id' => new MongoId($id)), $data);
    }
    
    public function etiquetaDeEnvio($id)
    {
        return $this->db->ordem->findOne(array("_id"=> new MongoId($id)));
    }
}
?>
