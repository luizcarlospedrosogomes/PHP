<?php

class Application_Model_DbTable_Ordem extends Zend_Db_Table_Abstract
{

    protected $_name = 'ordem';

      public function registraOS($filial, $equipamento, $marca, $obs, $usuario, $centroDeCusto,$quantidade, $idfilial)
    {
        $data = array(
                'idfilial' =>$idfilial,
                'centrodecusto' => $centroDeCusto,
                'idequipamento' =>$equipamento,
                'marca' => $marca,
                'quantidade'=>(int)$quantidade,
                'situacao' => 1,
                'obs' => $obs,
                'idusuario' => $usuario,
                'datacriacao' => strtotime(date('d-m-Y')),
        );
        $this->insert($data);
    }
    
    public function listaOrdem()
    {
        
       return $this->db->ordem->find();
                
    }
    
    public function excluir($id)
    {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
    	$this->delete($where);
   
    }
    
    public function listarOrdem($id)
    {
        return  $this->_db->fetchRow("SELECT filial.numero, filial.nome as flnome, equipamento.nome as equipnome, admin.usuario as user, ordem.situacao, ordem.centrodecusto, ordem.obs, ordem.datacriacao, ordem.quantidade, ordem.marca, ordem.id as idOrdem
                                       FROM ordem  JOIN filial ON filial.numero = ordem.idfilial
                                       JOIN equipamento ON equipamento.id = ordem.idequipamento
                                       JOIN admin ON admin.id = ordem.idusuario
                                        WHERE ordem.id = ".$id);
        
        
    }
     public function listarEnviados($situacao)
    {
           return $this->_db->fetchAll("SELECT filial.numero, filial.nome as flnome, equipamento.nome as equipnome, admin.usuario as user, ordem.situacao, ordem.centrodecusto, ordem.obs, ordem.datacriacao, ordem.quantidade, ordem.marca, ordem.id, ordem.dataedicao
                                       FROM ordem  JOIN filial ON filial.numero = ordem.idfilial
                                       JOIN equipamento ON equipamento.id = ordem.idequipamento
                                       JOIN admin ON admin.id = ordem.idusuario
                                        WHERE situacao = ".$situacao);
          // $cursor);
      
    }
    public function updateOrdem($id, $idfilial, $idequipamento, $marca, $situacao, $idusuario, $obs, $dataCriacao,$centroDeCusto,$quantidade,$dataEdicao)
    {
        $data = array(
                'idfilial' =>$idfilial,
                'centrodecusto' => $centroDeCusto,
                'marca' => $marca,
                'quantidade'=>(int)$quantidade,
                'situacao' => $situacao,
                'obs' => $obs,
                'dataedicao' => $dataEdicao               
            
        );
        
       
        $this->update($data, 'id='.$id);
    }
    public function etiquetaDeEnvio($id)
    {
         return  $this->_db->fetchRow("SELECT * FROM pendencias WHERE id =".$id);
    }
}

