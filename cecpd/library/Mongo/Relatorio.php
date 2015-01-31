<?php
class Mongo_Relatorio
{
    public $conectar;
    public $db;
   // public $collection;
    
    public function __construct()
    {
		$this->conectar = new Mongo();
		$this->db = $this->conectar-> cecpd;
    }
    
    public function equipamento()
    {
        return $this->db->ordem->find(array('equipamento'=>"MOUSE USB"));
    }
    
    public function saidaPorEquip()
    {
        return $this->db->ordem->distinct("equipamento");
    }
    public function saidaPorFilial()
    {
        $keys = array("filial" => 1);
        $initial = array("itens" => array());
        $reduce = "function (obj, prev){prev.itens.push(obj.equipamento);}";
        
        $collection = $this->db->ordem;
        return $g = $collection->group($keys, $initial, $reduce);
    }
    
    public function saidaPorEquipamento()
    {
        $keys = array("equipamento" => 1,"quantidade" => 1);
        $initial = array("itens" => array());
        $reduce = "function (obj, prev){prev.itens.push(obj.filial);}";
        
        $collection = $this->db->ordem;
        return $g = $collection->group($keys, $initial, $reduce);
    }
    public function saidaPorTecnico()
    {
        $keys = array("usuario" => 1);
        $initial = array("itens" => array());
        $reduce = "function (obj, prev){prev.itens.push(obj.filial);}";
        
        $collection = $this->db->ordem;
        return $g = $collection->group($keys, $initial, $reduce);
    }
    
    public function groupTeste()
    {
     $c = $this->db->ordem;
     
    $ops = array(
    array(
        '$project' => array(
            "equipamento" => 1,
           // "equipamento"   => 1,
        )
    ),
   
);
return $results = $c->aggregate($ops);           
    }
}