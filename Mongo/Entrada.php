<?php
class Mongo_Entrada
{
    public $conectar;
    public $db;
   // public $collection;
    
    public function __construct()
    {
		$this->conectar = new Mongo();
		$this->db = $this->conectar-> cecpd;
    }
    
    public function cadForn($cnpj, $nome, $endereco)
    {
        $data = array('cnpj' => $cnpj, 'nome' => $nome, 'endereco' => $endereco ,'RUA' => $rua);
        
        $collection = $this->db->fornecedor;
        
        $collection->insert($data);
    }
    
    public function listaForn()
    {
        return $this->db->fornecedor->find();
    }
    
    public function excluirForn($id)
    {
        $data = array('_id' => new MongoId($id));
	$colletion = $this->db->fornecedor;
		//var_dump($id);
	$colletion->remove($data); 
    }
    
    
   public function cadEquip($nome, $cat, $qtd,$nf,$forn, $valor, $date, $marca)
    {
       // var_dump($cat);
         $categoria = $this->db->cat->findOne(array("_id"=> new MongoId($cat)));
         $fornecedor = $this->db->fornecedor->findOne(array("_id"=> new MongoId($forn)));
         //var_dump($categoria['']);
        $data = array('idCat' => $categoria['categoria'], 'idForn' => $fornecedor['nome'], 'nome' => $nome, 'marca' => $marca,'qtd' => $qtd, 'valor' => $valor, 'dataEntrada' => $date );
        
        $collection = $this->db->equipamento;
        
        $collection->insert($data);
    }
    
     public function listaEquip()
    {
         return $this->db->equipamento->find();
    }
    
    public function excluirEquip($id)
    {
        $data = array('_id' => new MongoId($id));
	$colletion = $this->db->equipamento;
		//var_dump($id);
	$colletion->remove($data); 
    }
    
    public function cadFilial($nome, $num)
    {
        $data = array ('nome' => $nome, 'numero' => $num);
        $collection = $this->db->filial;
        
        $collection->insert($data);
    }
    public function listFilial()
    {
        return $this->db->filial->find();
    }
    public function excluirFilial($id)
    {
     $data = array('_id' => new MongoId($id));
	$colletion = $this->db->filial;
        //var_dump($id);
	$colletion->remove($data);    
    }
}