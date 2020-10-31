<?php namespace DAO;

use Models\Showing as Showing;

//use DAO\IGenderDAO as IGenderDAO;
use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\QueryType as QueryType;


class ShowingDAO implements IDAO{

    private $connection;
    private $tableName = 'Showings';
    
    public function GetAll(){
        try {
            $showingList = array();
            $query = 'SELECT * FROM '.$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row){
                $showing= new Showing();
                $showing->setIdShowing($row['id_Showing']);
                $showing->setDayTime($row['day']);
                $showing->setidMovie($row['idMovie']);
                $showing->setHrFinish($row['hrFinish']);
    
                array_push($showingList,$showing);
            }
            return $showingList;
            } catch (Exception $ex) {
                throw $ex;
            }
    }
    public function GetAllByRoom($idRoom){
        try {
            $showingList = array();
            $query = "SELECT * FROM ".$this->tableName." WHERE (idRoom = :idRoom)";;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row){
                $turn= new Turn($row['id_turno'],$row['hr_start'],$row['hr_finish']);
                $showing= new Showing();
    
                array_push($showingList,$showing);
            }
            return $showingList;
            } catch (Exception $ex) {
                throw $ex;
            }
    }

    public function Add(Showing $showing){
        try {  
            $query = 'INSERT INTO '.$this->tableName." (day,idMovie,idRoom,hrFinish) VALUES(:day,:idMovie,:idRoom,:hrFinish)";

            $parameters['day']=$showing->getDayTime();
            $parameters['idMovie']=$showing->getidMovie();
            $parameters['idRoom']=$showing->getRoom()->getId();
            $parameters['hrFinish']=$showing->getHrFinish();


            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);
        } catch (Exception $ex) {
            
            throw $ex;
        }
    }
}

?>