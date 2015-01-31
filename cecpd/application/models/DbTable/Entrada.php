<?php

class Application_Model_DbTable_Entrada extends Zend_Db_Table_Abstract
{

    protected $_name = 'entrada';

 public function cadForn($cnpj, $nome, $endereco)
    {
        $data = array('cnpj' => $cnpj, 'nome' => $nome, 'endereco' => $endereco);
        
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
    
    public function cadCat($cat)
    {
        //var_dump($cat);
        $data = array ('categoria'=>$cat);
        $collection = $this->db->cat;
        
        $collection->insert($data);
    }
    
    public function listaCat()
    {
         return $this->db->cat->find();
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
    
   
}

