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
            $query = 'SELECT s.id_Showing, s.day, s.idMovie, s.idRoom, s.hrFinish, r.id_Cine from '.$this->tableName.' s inner join room r on r.idRoom = s.idRoom order By r.id_Cine ;';

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

                array_push($showingList,$showing);
            }
            return $showingList;
            } catch (Exception $ex) {
                throw $ex;
            }
    }

    public function GetAllForMovie($idMovie){
        try {
            $showingList = array();
            $query = 'SELECT s.id_Showing, s.day, s.idMovie, s.idRoom, s.hrFinish, r.id_Cine from '.$this->tableName.' as s 
            inner join room r on r.idRoom = s.idRoom WHERE(s.idMovie = :idMovie);';

            $parameters["idMovie"] = $idMovie;
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

                array_push($showingList,$showing);
            }
            return $showingList;
            } catch (Exception $ex) {
                throw $ex;
            }
    }

    public function ShowingForDays($dayTimeStart,$dayTimeFinish)
        {
            $showingList=array();
            try {
                $procedure = 'call ShowingForDays(:days,:endDay);';

                $parameters['days']=$dayTimeStart;
                $parameters['endDay']=$dayTimeFinish;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($procedure,$parameters);
                
                foreach ($result as $value){

                $showing= new Showing();
                $showing->setIdShowing($value["id_Showing"]);
                $showing->setDayTime($value["day"]);
                $showing->setMovie();
                $showing->getMovie()->setId($value["idMovie"]);
                $showing->setRoom();
                $showing->getRoom()->setId($value["idRoom"]);
                $showing->setHrFinish($value["hrFinish"]);
                $showing->getRoom()->setCinema();
                $showing->getRoom()->getCinema()->setId($value['id_Cine']);
                   
                array_push($showingList,$showing);
                }

                return $showingList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }
        
        public function GetShowingForDay($dayTime){
            try {
                //var_dump($dayTime);
                $showingList = array();
                
                $procedure = 'call ShowingForDay(:dayTime);';
    
                $parameters["dayTime"] = $dayTime;
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($procedure,$parameters);
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
                    array_push($showingList,$showing);
                }
                
                return $showingList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }

        public function GetPrice($id){
            try {
            
                $query = 'SELECT r.price_ticket from '.$this->tableName.' as s 
                inner join room r on r.idRoom = s.idRoom 
                WHERE(s.id_Showing = :id);';
    
                $parameters["id"] = $id;
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query,$parameters);
                
                var_dump($result[0]["price_ticket"]);
                
                return $result[0]["price_ticket"];
                } catch (Exception $ex) {
                    throw $ex;
                }
        }


        
        
}
?>