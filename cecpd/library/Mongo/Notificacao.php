<?php
class Mongo_Notificacao
{
    public $conectar;
    public $db;
   // public $collection;
    
    public function __construct()
    {
		$this->conectar = new Mongo();
		$this->db = $this->conectar->cecpd;
    }
    
    public function ordemSaida($idSaida, $data)
    {
        $data = array('idSaida' => $idSaida, 'dataEmail' => $data);
        
        $collection = $this->db->notificacao;
        
        $collection->insert($data);
    }
    
    public function listOrdemSaida($idSaida)
    {
        return $this->db->notificacao->findOne(array('idSaida' => $idSaida));
    }
}