<?php

class SaidaController extends Zend_Controller_Action
{

    public function init()
    {
         if ( !Zend_Auth::getInstance()->hasIdentity() ) {
		return $this->_helper->redirector->goToRoute( array('controller' => 'login'), null, true);
		}
          
    }
    

    public function indexAction()
    {
        $this->view->titulo = "Saida - Ordem de Servico";
        $this->view->h1 = "Saida - Ordem de Servico";
        $lista = new Mongo_Saida();
        $list = $lista->listaOrdem();
      
        
        $entrada = new Application_Model_DbTable_Filial();
        $filial = $entrada->listFilial();
        
        $listEquip = new Application_Model_DbTable_Equipamento();
        $equip = $listEquip->listarEquipTotal();
        //var_dump($equip);
        $this->view->filiais = $filial;
        $this->view->equipamento = $equip;
        //var_dump($list);
        $this->view->liste = $list;
        $usuario = Zend_Auth::getInstance()->getIdentity();
        
    }

    public function geraosAction()
    {
        //Desativar o layout
    	$this->_helper->layout->disableLayout();
    	
    	//Desativar a view
    	$this->_helper->viewRenderer->setNoRender();
    	
        $pega = Zend_Auth::getInstance()->getIdentity();
        //var_dump($pega);
        $usuario = $pega->id;
        
        if($_POST)
        {
            $filial = $_POST['filial'];
            $flexplode = explode('-', $filial);
            $idfilial = $flexplode[0];
            $centroDeCusto = $_POST['centroDeCusto'];
            $equipamento = $_POST['equipamento'];
            $marca = $_POST['marca'];
            $quantidade = $_POST['quantidade'];
            $obs = $_POST['obs'];
            
            $registra = new Application_Model_DbTable_Ordem();
            $registra->registraOS($filial, $equipamento, $marca, $obs, $usuario, $centroDeCusto,$quantidade,$idfilial);
            
            $this->_redirect('saida');
        }
        
        echo "Ocorreu um erro.";
    }

    public function excluirAction()
    {
        //Desativar o layout
    	$this->_helper->layout->disableLayout();
    	
    	//Desativar a view
    	$this->_helper->viewRenderer->setNoRender();
        
    	$pega = Zend_Auth::getInstance()->getIdentity();
        
        if($pega->usuario == 'admin')
        {
            $id = $this->_getParam('id');

            $excluir = new Application_Model_DbTable_Ordem();
            $excluir->excluir($id);

            $this->_redirect('saida');
        }
       echo "Voce nao tem permissao.Entre em contato com o Administrador"; 
    }

    public function ajaxeditarAction()
    {
       //Desativar o layout
    	$this->_helper->layout->disableLayout();
    	
        $pega = Zend_Auth::getInstance()->getIdentity();
        //var_dump($pega);
        if($pega->usuario == 'admin')
        {
            $id =(int) $_POST['id'];
           // var_dump($id);
            $list = new Application_Model_DbTable_Ordem();
            $liste = $list->listarOrdem($id);
            //var_dump($liste);
            $this->view->listar =   $liste ;
        }else{
        
            echo "<strong>Voce nao tem permissao.Entre em contato com o Administrador</strong>";
            //Desativar a view
            $this->_helper->viewRenderer->setNoRender();
        }
        
    }

    public function updateosAction()
    {
         //Desativar o layout
    	$this->_helper->layout->disableLayout();
    	
    	//Desativar a view
    	$this->_helper->viewRenderer->setNoRender();
        
        if($_POST)
        {
            $id =(int) $_POST['id'];
            
            $filial = $_POST['filial'];
            $flexpl = explode("-", $filial);
            $idfilial = $flexpl[0];
            
            $centroDeCusto = $_POST['centroDeCusto'];
            $idequipamento = $_POST['equipamento'];
            $marca = $_POST['marca'];
            $quantidade = $_POST['quantidade'];
            $idusuario = $_POST['usuario'];
            $situacao = (int)$_POST['situacao'];
            $dataCriacao = $_POST['dataCriacao'];
            $obs = $_POST['obs'];
            $dataEdicao = date('d/m/Y');
            $update = new Application_Model_DbTable_Ordem();
            $update->updateOrdem($id, $idfilial, $idequipamento, $marca, $situacao, $idusuario, $obs, $dataCriacao,$centroDeCusto,$quantidade,$dataEdicao);
            
            $this->_redirect('saida');
        }
    }
   
}