<?php namespace DAO;

use Models\Showing as Showing;

//use DAO\IGenderDAO as IGenderDAO;
use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\QueryType as QueryType;


class MovieDAO implements IDAO{

    private $connection;
    private $tableName = 'Showings';
    
    public function GetAll(){
        try {
            $turnList = array();
            $query = 'SELECT * FROM '.$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row){
                $turn= new Turn($row['id_turno'],$row['hr_start'],$row['hr_finish']);
    
                array_push($turnList,$turn);
            }
            return $turnList;
            } catch (Exception $ex) {
                throw $ex;
            }
    }

    public function Add(Turn $turn){
        try {
            $query = 'INSERT INTO '.$this->tableName." (hr_start,hr_finish) VALUES(:hr_start,:hr_finish)";

            $parameters['hr_start']=$turn->getHrStart();
            $parameters['hr_finish']=$turn->getHrFinish();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);
        } catch (Exception $ex) {
            
            throw $ex;
        }
    }



        
}

?>