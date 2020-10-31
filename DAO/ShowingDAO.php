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
            $query = 'SELECT s.id_Showing, s.day, s.idMovie, s.idRoom, s.hrFinish, r.id_Cine from '.$this->tableName.' s inner join room r on r.idRoom = s.idRoom;';

            //$query = 'SELECT r.capacidad from room r inner join '.$this->tableName.' s on (r.idRoom = :idRoom);';

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);
            
            foreach($result as $row){
                $showing= new Showing();
                $showing->setIdShowing($row['id_Showing']);
                $showing->setDayTime($row['day']);
                $showing->setMovie();
                $showing->getMovie()->setId($row['idMovie']);
                $showing->setRoom();
                $showing->getRoom()->setId($row['idRoom']);
                $showing->getRoom()->setCinema();
                $showing->getRoom()->getCinema()->setId($row['id_Cine']);
                $showing->setHrFinish($row['hrFinish']);
    
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
            $parameters['idMovie']=$showing->getMovie()->getId();
            $parameters['idRoom']=$showing->getRoom()->getId();
            $parameters['hrFinish']=$showing->getHrFinish();


            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);
        } catch (Exception $ex) {
            
            throw $ex;
        }
    }

    public function GetAllForRoom($idRoom){
        try {
            $showingList = array();
            $query = 'SELECT s.id_Showing, s.day, s.idMovie, s.idRoom, s.hrFinish, r.id_Cine from '.$this->tableName.' s inner join room r on r.idRoom = s.idRoom WHERE (s.idRoom = :idRoom);';

            $parameters["idRoom"] = $idRoom;
            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query,$parameters);
            foreach($result as $row){
                $showing= new Showing();
                $showing->setIdShowing($row["id_Showing"]);
                $showing->setDayTime($row["day"]);
                $showing->setMovie();
                $showing->getMovie()->setId($row["idMovie"]);
                $showing->setRoom();
                $showing->getRoom()->setId($row["idRoom"]);
                $showing->setHrFinish($row["hrFinish"]);

                $showing->getRoom()->setCinema();
                $showing->getRoom()->getCinema()->setId($row['id_Cine']);
                //$room->setCinema($row["id_Cine"]);

                //var_dump($room);
                array_push($showingList,$showing);
            }
            return $showingList;
            } catch (Exception $ex) {
                throw $ex;
            }
    }



        
}

?>