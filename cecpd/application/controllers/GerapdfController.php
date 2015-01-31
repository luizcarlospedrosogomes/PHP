<?php

class GerapdfController extends Zend_Controller_Action
{

    public function init()
    {
     
    }

    public function indexAction()
    {
      
      $pega = Zend_Auth::getInstance()->getIdentity();
      if($pega->usuario == 'admin')
      {      
      $id = $this->getParam('id');
      $list = new Application_Model_DbTable_Ordem();
      $listar = $list->listarOrdem($id);
      
        $pdf = new Zend_Pdf();

        $pdfPage = $pdf->newPage(Zend_Pdf_Page::SIZE_A4_LANDSCAPE);
        
        $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_COURIER);
        $font_bold = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_COURIER_BOLD);
        

        $pdfPage->setFont($font_bold, 100)
                ->drawText('DE CPD', 205, 484, 'UTF-8')
                ->drawText('PARA FL:' . $listar['numero'], 95, 420, 'UTF-8')
                ->drawText(' '. $listar['flnome'], 95, 350, 'UTF-8');
        $pdfPage->setFont($font_bold, 15);
        $pdfPage->drawText('Favor enviar equipamento danificado para CDAM com Nota Fiscal', 20, 300, 'UTF-8');
        $pdfPage->drawText('Para emissão da Nota Fiscal passar um email para sandra.castro@mercadomoveis.com.br', 20, 280, 'UTF-8');
        $pdfPage->setFont($font, 10);
        $pdfPage->drawText('Dados do Email: ASSUNTO:Devolução Para o CPD; CONTEUDO: Descrição do patrimonio e numero do patrimonio. Ex: Monitor 15" = pat:12321.', 20, 250, 'UTF-8');
        $pdfPage->drawText('Apos a emissão da Nota Fiscal existe um prazo de 3 dias para o equipamento trafegar', 20, 220, 'UTF-8');
        $pdfPage->drawText('Atenção ao Codicionamento e Identificação do Equipamento', 20, 190, 'UTF-8');
        $pdfPage->drawText('Preparado para envio em ' . date('d/m/Y'), 280, 160, 'UTF-8');
        $pdfPage->drawText('Observações:  ' . $listar['obs'] . ';', 280, 130, 'UTF-8');
        $pdfPage->drawText('Equipamento enviado:   ' . $listar['equipnome'], 280, 115, 'UTF-8');
//data de envio

        $pdf->pages[0] = $pdfPage;

        header('Content-type: application/pdf');
        echo $pdf->render();
        }else{
             
        }
    }

    public function ordemAction()
    {
      $pega = Zend_Auth::getInstance()->getIdentity();
      if($pega->usuario == 'admin')
      {
       $id = $this->getParam('id');
       $list = new Application_Model_DbTable_Ordem();
       $listar = $list->listarOrdem($id);
       //var_dump($listar);
           
        $pdf = new Zend_Pdf();

        $pdfPage = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
        //for ($i;$i=1;$i++)        {
        
        $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_COURIER);
        $font_bold = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_COURIER_BOLD);
        
        $pdfPage->setFont($font_bold, 30)
                ->drawText('Mercado Moveis', 175, 770, 'UTF-8');
//
        $pdfPage->setFont($font, 10)
                ->drawText('Data: '.date('d/m/Y'), 475, 800);
        
        $pdfPage->setFont($font_bold, 25)
                ->drawText('Ordem de Saida', 190, 750);
        
        $pdfPage->setFont($font, 15)
                ->drawText('ROTAS: SEG | TER | QUA | QUI | SEX | SAB |    BOX: ', 40, 720);
        
        $pdfPage->setFont($font, 20)
                ->drawText('Filial: '.$listar['flnome'], 40, 700);
      //  $pdf->pages[0] = $pdfPage;
        
        $pdfPage->setFont($font, 15)
                ->drawText('Equipamento: '.$listar['equipnome'], 40, 650);
        
        $pdfPage->setFont($font, 15)
                ->drawText('Marca: '.$listar['marca'], 40, 620);
        
        $pdfPage->setFont($font, 15)
                ->drawText('Observacao: '.$listar['obs'], 40, 590);
        
        $pdfPage->setFont($font, 10)
                ->drawText('Tecnico Responsavel: '.$listar['user'], 40, 550);
        
        $pdfPage->setFont($font, 10)
                ->drawText('Responsavel Pelo Carregamento: ', 300, 550);
        
    //segunda parte
        $pdfPage->setFont($font_bold, 30)
                ->drawText('Mercado Moveis', 175, 370, 'UTF-8');
//
        $pdfPage->setFont($font, 10)
                ->drawText('Data: '.date('d/m/Y'), 475, 400);
        
        $pdfPage->setFont($font_bold, 25)
                ->drawText('Ordem de Saida', 190, 350);
        
        $pdfPage->setFont($font, 15)
                ->drawText('ROTAS: SEG | TER | QUA | QUI | SEX | SAB |    BOX: ', 40, 320);
        
        $pdfPage->setFont($font, 20)
                ->drawText('Filial: '.$listar['flnome'], 40, 300);
      //  $pdf->pages[0] = $pdfPage;
        
        $pdfPage->setFont($font, 15)
                ->drawText('Equipamento: '.$listar['equipnome'], 40, 250);
        
        $pdfPage->setFont($font, 15)
                ->drawText('Marca: '.$listar['marca'], 40, 220);
        
        $pdfPage->setFont($font, 15)
                ->drawText('Observacao: '.$listar['obs'], 40, 190);
        
        $pdfPage->setFont($font, 10)
                ->drawText('Tecnico Responsavel: '.$listar['user'], 40, 150);
        
        $pdfPage->setFont($font, 10)
                ->drawText('Responsavel Pelo Carregamento: ', 300, 150);
        //$i++;}
        $pdf->pages[0] = $pdfPage;
      
        header('Content-type: application/pdf');
        echo $pdf->render();
      }
    }

    public function pendenciasAction()
    {
        
      $pega = Zend_Auth::getInstance()->getIdentity();
      if($pega->usuario == 'admin')
      {      
      $id = $this->getParam('id');
      $list = new Mongo_Teste();
      $listar = $list->listarpendencias($id);
       //var_dump($listar);
           
        $pdf = new Zend_Pdf();

        $pdfPage = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
        
        $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_TIMES);
        $font_bold = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_COURIER_BOLD);
        

        $pdfPage->setFont($font_bold, 50)
                ->drawText('Mercado Moveis', 80, 760, 'UTF-8');
        $pdfPage->setFont($font, 30)
                ->drawText('Termo de Emprestimo CPD - Usuario', 55, 730, 'UTF-8');
         $pdfPage->setFont($font, 10)
                ->drawText('Data: '.date('d/m/Y'), 475, 800);
         $pdfPage->setFont($font, 15)
                ->drawText('A Assistencia Tecnica cede ao usuario: '.$listar['nome'], 40, 700,'UTF-8');
         $pdfPage->setFont($font, 15)
                ->drawText('Matricula: '.$listar['matricula'], 40, 680,'UTF-8')
                ->drawText('Setor: '.$listar['setor'], 280, 680,'UTF-8')
                ->drawText('O seguinte equipamento: '.$listar['equipamento'], 40, 660,'UTF-8')
                ->drawText('Observações: '.$listar['obs'], 40, 640,'UTF-8');
          $pdfPage->setFont($font_bold, 10)
                  ->drawText('O senhor '.$listar['nome'].' se compromete em devolver ate o dia '.date('d/m/Y',$listar['dataDevolucao']), 40, 600);
           $pdfPage->setFont($font, 10)
                   ->drawText('Assinatura Tec. Responsável', 120, 540, 'UTF-8')
                   ->drawText('____________________________________________', 60, 550, 'UTF-8')
                   ->drawText('Assinatura Usuário', 420, 540, 'UTF-8')
                   ->drawText('____________________________________________', 360, 550, 'UTF-8');
            $pdfPage->setFont($font, 8)
                   ->drawText('via CPD', 520, 500, 'UTF-8')
                   ->drawText('------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 490, 'UTF-8');
         
         $pdfPage->setFont($font_bold, 50)
                ->drawText('Mercado Moveis', 80, 420, 'UTF-8');
        $pdfPage->setFont($font, 30)
                ->drawText('Termo de Emprestimo CPD - Usuario', 55, 390, 'UTF-8');
         $pdfPage->setFont($font, 10)
                ->drawText('Data: '.date('d/m/Y'), 475, 460);
         $pdfPage->setFont($font, 15)
                ->drawText('A Assistencia Tecnica cede ao usuario: '.$listar['nome'], 40, 360,'UTF-8');
         $pdfPage->setFont($font, 15)
                ->drawText('Matricula: '.$listar['matricula'], 40, 340,'UTF-8')
                ->drawText('Setor: '.$listar['setor'], 280, 340,'UTF-8')
                ->drawText('O seguinte equipamento: '.$listar['equipamento'], 40, 320,'UTF-8')
                ->drawText('Observações: '.$listar['obs'], 40, 300,'UTF-8');
          $pdfPage->setFont($font_bold, 10)
                  ->drawText('O senhor '.$listar['nome'].' se compromete em devolver ate o dia '.date('d/m/Y',$listar['dataDevolucao']), 40, 280);
           $pdfPage->setFont($font, 10)
                   ->drawText('Assinatura Tec. Responsável', 120, 220, 'UTF-8')
                   ->drawText('____________________________________________', 60, 230, 'UTF-8')
                   ->drawText('Assinatura Usuário', 420, 220, 'UTF-8')
                   ->drawText('____________________________________________', 360, 230, 'UTF-8');
            $pdfPage->setFont($font, 8)
                   ->drawText('via Usuario', 520, 180, 'UTF-8')
                   ->drawText('------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 490, 'UTF-8');
       
        
        $pdf->pages[0] = $pdfPage;

        header('Content-type: application/pdf');
        echo $pdf->render();
        }else{
             
        }
    }

        public function naopermitidoAction()
    {
        // action body
    }

}







