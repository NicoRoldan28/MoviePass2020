<?php namespace DAO;

use Models\Turn as Turn;

use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\QueryType as QueryType;


class TurnDAO implements IDAO{

    private $connection;
    private $tableName = 'Turns';
    
    public function GetAll(){
        try {
            $turnList = array();
            $query = 'SELECT * FROM '.$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row){
                $turn= new Turn();
                $turn->setId($row['id_turno']);
                $turn->setHrStart($row['hr_start']);
                $turn->setHrFinish($row['hr_finish']);

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