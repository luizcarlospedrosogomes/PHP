<?php

class RelatorioController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
       $this->view->titulo = "Relatorios";
       $this->view->h1 = "Relatorios - Filial | Equipamento | Tecnico";
       
       $relatorio = new Application_Model_DbTable_Relatorio();
       $relTeste = $relatorio->contaEquip();
       $this->view->relEquip = $relTeste;
    }

    public function planilhaAction()
    {
        $planilha = new Spreadsheet_Writer();
        $planilha->write(0, 0, "Primeira linha, primeira coluna");
    }

    public function relfilialajaxAction()
    {
        //Desativar o layout
    	$this->_helper->layout->disableLayout();
        
        $relatorio = new Mongo_Relatorio();
        $filiais = $relatorio->saidaPorFilial();
        $this->view->filial = $filiais;
    }

    public function relequipajaxAction()
    {
        //Desativar o layout
    	$this->_helper->layout->disableLayout();
        
        $relatorio = new Mongo_Relatorio();
        $relEquip = $relatorio->saidaPorEquipamento();
        
        $this->view->equipamento = $relEquip;
        
    }

       public function reltecnicoajaxAction()
    {
        //Desativar o layout
    	$this->_helper->layout->disableLayout();
        
        $relatorio = new Mongo_Relatorio();
        $relTecnico = $relatorio->saidaPorTecnico();
        
        $this->view->tecnico = $relTecnico;
    }


}











