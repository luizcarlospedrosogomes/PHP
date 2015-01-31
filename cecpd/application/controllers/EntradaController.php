<?php

class EntradaController extends Zend_Controller_Action
{

    public function init()
    {
       if ( !Zend_Auth::getInstance()->hasIdentity() ) {
		return $this->_helper->redirector->goToRoute( array('controller' => 'login'), null, true);
		}
    }

    public function indexAction()
    {
        $this->view->titulo = "Entrada";
        $this->view->h1 = "Entrada e Cadastros";
        
       $listarCat = new Application_Model_DbTable_Categoria();
       $cat = $listarCat->listaCat();
       $listarForn = new Application_Model_DbTable_Fornecedor();
       $forn = $listarForn->listaForn();
       $this->view->categoria = $cat;
       $this->view->fornecedor = $forn;
       
       //var_dump($list);
       
    }
    
    public function cadfornAction()
    {
     //Desativar o layout
    	$this->_helper->layout->disableLayout();
    	
    	//Desativar a view
    	$this->_helper->viewRenderer->setNoRender();
    	
        if($_POST)
        {
            $cnpj = $_POST['cnpj'];
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            
            $cadastrar = new Application_Model_DbTable_Fornecedor();
            $cadastrar->cadForn($cnpj, $nome, $endereco);
            
            $this->_redirect('entrada');
        }
    }
        public function excluirAction()
        {
          //Desativar o layout
    	$this->_helper->layout->disableLayout();
    	
    	//Desativar a view
    	$this->_helper->viewRenderer->setNoRender();
    	
            $id = (int) $this->getParam('id');
         if(isset($id))
         {
            $excluir = new Application_Model_DbTable_Fornecedor();
            $excluir->excluirForn($id);
            
            $this->_redirect('entrada');
            
           
         }
         $this->view->erro = "Indice  nao encontrado";
        }
        
        public function cadcatAction()
        {
           //Desativar o layout
    	$this->_helper->layout->disableLayout();
    	
    	//Desativar a view
    	$this->_helper->viewRenderer->setNoRender();
    	
            $cat = $_POST['cat'];
            
            $inserir = new Application_Model_DbTable_Categoria();
            $inserir->cadCat($cat);
            
            $this->_redirect('entrada');
                
        }
         
        public function cadequipAction()
        {
                //Desativar o layout
    	$this->_helper->layout->disableLayout();
    	
    	//Desativar a view
    	$this->_helper->viewRenderer->setNoRender();
    	
            if($_POST)
            {
                $nome = $_POST['nome'];
                $cat = $_POST['categoria'];
                $marca = $_POST['marca'];
                $forn = $_POST['fornecedor'];
                $nf = $_POST['nf'];
                $valor = $_POST['nf'];
                $qtd = $_POST['qtd'];
                $date = date('d/m/Y');
              
              $inserir = new Application_Model_DbTable_Equipamento();
              $inserir->cadEquip($nome, $cat, $qtd, $nf, $forn, $valor, $date, $marca);
                
            }
        }
        
        public function cadfilialAction()
        {
            if($_POST)
            {
                $num = $_POST['num'];
                $nome = $_POST['nome'];
                
                $cadastra = new Application_Model_DbTable_Filial();
                $cadastra->cadFilial($nome, $num);
                
                $this->_redirect('entrada');
            }
        }


}

