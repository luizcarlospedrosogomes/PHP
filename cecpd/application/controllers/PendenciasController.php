<?php

class PendenciasController extends  Zend_Controller_Action
{
    //public  $usuario ;
    public function init()
    {
           if ( !Zend_Auth::getInstance()->hasIdentity() ) {
		return $this->_helper->redirector->goToRoute( array('controller' => 'login'), null, true);
		}
              
    }

    public function indexAction()
    {
     
       $this->view->titulo = "Pendencias";
       $this->view->h1 = "Relacao de Pendencias";
       
       $list = new Application_Model_DbTable_Pendencias();
       $ver = $list->listar();
       //var_dump($ver);
       $this->view->listmongo = $ver;
       $usuario = Zend_Auth::getInstance()->getIdentity();
       
        /* @var $usuario type */
      // var_dump($usuario);
    }
	
    public function messagem()
    {
    	$flash = $nada;
    }
    
    public function pendcdamAction()  
    {
    	//Desativar o layout
    	$this->_helper->layout->disableLayout();
    	
    	//Desativar a view
    	$this->_helper->viewRenderer->setNoRender();
    	
        
    	
        if($_POST)
    	{
    		$matricula = $_POST['matricula'];
    		$nome = $_POST['nome'];
    		$setor = $_POST['setor'];
    		$email = $_POST['email'];
    		$equipamento = $_POST['equip'];
    		//$condicoes = $_POST['estado'];
    		$dataDevolucao = $_POST['dataDevolucao'];
    		$obs = $_POST['obs'];
    		
    		//aqui vai a model
    		$insere = new Application_Model_DbTable_Pendencias();
    		$insere->gerarPendecia($nome, $matricula, $setor, $email, $equipamento, $dataDevolucao,$obs);
    		
    		$smtp = "smtp.mercadomoveis.com.br";
    		try {
    			$config = array (
    					'auth' => 'login',
    					'username' => 'luizcarlos',
    					'password' => 'corrida',
    					'port' => '587'
    			);
    		
    				
    			$mailTransport = new Zend_Mail_Transport_Smtp($smtp, $config);
    				
    			$mail = new Zend_Mail();
    			$mail->setFrom('luizcarlos@mercadomoveis.com.br');
    			$mail->addTo('luizcarlos@mercadomoveis.com.br','lc.pg@hotmail.com',$email);
    			$mail->setBodyHtml('<p> Ola </p><p> Caro Usuario. Voce acabou de retirar um equipamento no Estouqe do CPD.</p>
									<p>O '.$equipamento.' deve ser devolvido ate '. $dataDevolucao.' como combinamos</p>
									<p>Esperamos que seja util durante esse periodo</p>
									<p>Nao se esqueca de nos entregar.</p>
									');
    			$mail->setSubject('Emprestimo de Equipamento');
    			$mail->send($mailTransport);
    				
    			                           
    		} catch (Exception $e){
    			echo ($e->getMessage());
    			echo ". Falha. Verifique conexao e endereco de email";
    		}//fim catch
    		
    		echo "email OK";
    	}
    }
    
    public  function excluirAction()
    { 
    	//Desativar o layout
		$this->_helper->layout->disableLayout();
		 
		//Desativar a view
		$this->_helper->viewRenderer->setNoRender();
		
		
		$id = $this->_getParam('id');
		//var_dump($id);
		
		$remove = new Mongo_Teste();
		$remove->excluir($id);
		
		$this->_redirect('pendencias');
		
    } 
    
   

}

