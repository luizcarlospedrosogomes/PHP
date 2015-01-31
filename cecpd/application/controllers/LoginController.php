<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        if ($_POST)
        {
        	$usuario = $_POST['usuario'];
        	$senha = $_POST['senha'];
        	
        	// Pega as informa��es do adaptador do banco de dados.
        	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
        	 
        	// Inicia o adaptador Zend_Auth para banco de dados.
        	// � definido a tabela do db e os campos que ser�o usados
        	// para comparar com os campos de login.
        	$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        	
        	$authAdapter->setTableName('admin')
        				->setIdentityColumn('usuario')
        				->setCredentialColumn('senha');
        				//->setCredentialTreatment('MD5(?)');
        //	var_dump($authAdapter);
        	$authAdapter->setIdentity($usuario)
        				->setCredential($senha);
        // Pega a inst�ncia atual do Zend_Auth.
                $auth = Zend_Auth::getInstance();
                 
                // Pega o resultado da compara��o dos dados enviados com os registrados.
                $result = $auth->authenticate($authAdapter);
                 
                // Caso o resultado seja positivo, o login � efetuado.
                if( $result->isValid() ) {               
                                  
                 // Pega o nome do usu�rio.
                 $user = $authAdapter->getResultRowObject();
                  
                 // Salva o nome do usu�rio para uso na sess�o.
                 $auth->getStorage()->write($user);
                  
                 // Redireciona para a primeira p�gina ap�s o login.
                 //var_dump($user);
                 if(!$user->usuaio == 'admin'){
                      $this->_redirect("saida" );
                 }
                 $this->_redirect("pendencias" );
               
                }else{ 
                	
                	echo "Erro no login";
                	$this->_redirect('login');
                
               		 }
        	
         }
         
         
    }
    public function logoutAction(){
    
    	// Apaga da inst�ncia do Zend Auth a identifica��o no sistema.
    	Zend_Auth::getInstance()->clearIdentity();
    	 
    	// Redireciona para a p�gina inicial do site.
    	$this->_redirect('index');
    	
    	 
    }

}



