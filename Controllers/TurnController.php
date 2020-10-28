<?php namespace Controllers;

use Models\Turn as Turn;

use DAO\TurnDAO as TurnDAO;

class TurnController{
    private $turnDAO;

    public function __construct()
    {
        $this->turnDAO= new TurnDAO();
    }
    
    public function ShowListView()
    {
        require_once(VIEWS_PATH."validate-session.php");
        $turnList=array();
        $turnList=$this->turnDAO->getAll();
        var_dump ($turnList);
        //var_dump($showingList);
        //require_once(VIEWS_PATH."showingListAdmin.php");
        //require_once(VIEWS_PATH."showingListAdmin.php");
    }

    public function ShowAddView()
    {
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."turn-add.php");
    }


    public function Index($message = "")
    {
        require_once(VIEWS_PATH."Home.php");
    }

    public function RegisterTurn($hrStart,$hrFinish)
    {
        //date_default_timezone_set('América/Argentina/Buenos Aires');
        //$fechaActual=date("Y-m-d");
        $turn= new Turn();

        $turn->setHrStart($hrStart);        
        $turn->setHrFinish($hrFinish);
        ($this->turnDAO->verify());
        //{
            //$this->turnDAO->Add($turn);
            //$this->ShowAddView();
        //}
        /*else{
            echo "hay un problema con las horas para el turno seleccionado";
        }*/
        
        
        
        
        require_once(VIEWS_PATH."nav-admin.php");
    }
}
?>