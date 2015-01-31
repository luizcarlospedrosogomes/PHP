<?php

class AjaxController extends Zend_Controller_Action
{

    public function init()
    {
       //Desativar o layout
    $this->_helper->layout->disableLayout();
    }

    public function indexAction()
    {
        // action body
    }

    public function editarAction()
    {
        // action body
        $id = (int) $_POST['id'];
       // echo $id;
        
        $list = new Application_Model_DbTable_Pendencias();
        $listar = $list->listarpendencias($id);
        
        $this->view->ver = $listar;
       // var_dump($listar);
        
        //foreach ($listar as $ls){var_dump($ls);}
    }

    public function updatependenciasAction()
    {
    	//Desativar o layout
    	$this->_helper->layout->disableLayout();
    	 
    	//Desativar a view
    	$this->_helper->viewRenderer->setNoRender();
        if($_POST)
        {
            $id =(int) $_POST['id'];
            $matricula = $_POST['matricula'];
            $nome = $_POST['nome'];
            $setor = $_POST['setor'];
            $email = $_POST['email'];
            $equipamento = $_POST['equip'];
            $situacao = (int)$_POST['situacao'];
            //$condicoes = $_POST['estado'];
            $dataDevoluvao = $_POST['dataDevolucao'];
            $obs = $_POST['obs'];

            $update = new Application_Model_DbTable_Pendencias();
            $update->updatependencias($id,$nome, $matricula, $setor, $email, $equipamento,$situacao, $dataDevoluvao,$obs);
            
           // $this->_redirect('pendencias');
        }
        
        var_dump($id);    
        echo "Ocorreu um Erro";
    }

    public function listaequipAction()
    {
        $entrada = new Application_Model_DbTable_Equipamento();
        $equipamento = $entrada->listaEquip();
        //var_dump($equipamento);
        $this->view->equip = $equipamento;
    }

    public function excluirequipAction()
    {
     //Desativar a view
    	$this->_helper->viewRenderer->setNoRender();
        
    	$id =(int) $this->getParam('id');
        
        $excluir = new Application_Model_DbTable_Equipamento();
        $excluir->excluirEquip($id);
        
        $this->_redirect('entrada');
        
        
    }

    public function listaenviadosAction()
    {
        $situacao = (int)$_POST['situacao'];
        // var_dump($situacao);
        
        $listaSituacao = new Application_Model_DbTable_Ordem();
        $listSituacao = $listaSituacao->listarEnviados($situacao);
        
        $this->view->verSituacao = $listSituacao;
    }

    public function listafilialAction()
    {
        $filial = new Application_Model_DbTable_Filial();
        $fl = $filial->listFilial();
        $this->view->filiais = $fl;
    }
    public function excluirfilialAction()
    {
        $id =(int) $this->getParam('id');
        $excluir = new Application_Model_DbTable_Filial();
        $excluir->excluirFilial($id);
        
        $this->_redirect('entrada');
    }


}









