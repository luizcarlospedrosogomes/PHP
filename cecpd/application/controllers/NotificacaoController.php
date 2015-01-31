<?php

class NotificacaoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function ordememailAction()
    {
     //Desativar o layout
    	$this->_helper->layout->disableLayout();
    	
    	//Desativar a view
    	$this->_helper->viewRenderer->setNoRender();
    	
        
      $pega = Zend_Auth::getInstance()->getIdentity();
      if($pega->usuario == 'admin'){
          
      
      $id = $_POST['id'];
      $notificacao = new Application_Model_DbTable_Notificacao();
      $notifiqOk = $notificacao->listOrdemSaida($id);
      if($notifiqOk['idordem'] == $id)
      {
         echo "Email ja enviado" ;
      }else{
      $salvaidordem = new Application_Model_DbTable_Notificacao();
      
      $list = new Application_Model_DbTable_Ordem();
      $listar = $list->etiquetaDeEnvio($id);
      
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
    	$mail->addTo('lc.pg@hotmail.com');
        $mail->setBodyHtml('<p> Transferencia da CDAM para a  Filiais </p><p>Filial: '.$listar['numero']." ".$listar['flnome'].'</p>
                            <p>Equipamento: '.$listar['equipnome'].'</p>
                            <p>Marca: '.$listar['marca'].'</p>
                            <p>Observacao :'.$listar['obs'].'</p>
                             <p>Tecnico Responsavel : '.$listar['user'].'
                            <p>Muito Obrigado.</p>
                                 
									');
    			$mail->setSubject('Saida CPD - '.$listar['numero']." ".$listar['flnome']);
    			$mail->send($mailTransport);
    		
    	
        $salvaidordem->ordemSaida($id);
        
        echo "Email enviado com Sucesso";
        
        }catch (Exception $e){
    			echo ($e->getMessage());
    			echo ". Falha. Verifique conexao e endereco de email";
    		}//fim catch	
      
      
      }}
        else {
      echo "Voce nao possui permissao!"    ;
      }
    
    
    }

}



