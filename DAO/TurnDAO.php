<?php namespace DAO;

use Models\Turn as Turn;
<<<<<<< HEAD
=======

>>>>>>> Rodrigo
use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\QueryType as QueryType;

<<<<<<< HEAD
class TurnDAO{
    private $connection;
    private $tableName = 'Turns';

        public function GetAll(){
            try {
                $turnsList = array();
                $query = 'SELECT * FROM '.$this->tableName;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $row){
                    $turn= new Turn();
                    $turn->setId($row['id_turno']);
                    $turn->setHrStart($row['hr_start']);
                    $turn->setHrFinish($row['hr_finish']);
        
                    array_push($turnsList,$turn);
                }
                return $turnsList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }
        
        public function getTurnForId($id){
            try {
                //$turnList = array();
                //var_dump($ShowingsList);
                //var_dump($idMovie);
                $query = 'SELECT * FROM '.$this->tableName." WHERE (id_turno = :id)";
                
                $parameters['id'] = $id;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query,$parameters);
    
                foreach($result as $row){
                    $turn= new Turn;

                    $turn->setId($row["id_turno"]);
                    $turn->setHrStart($row["hr_start"]);
                    $turn->setHrFinish($row["hr_finish"]);
  
                    //array_push($turnList,$turn);
                }
                return $turn;
            } catch (Exception $ex) {
                throw $ex;
            }
        }

        public function Add(Turn $turn){
            try {
                $query = 'INSERT INTO '.$this->tableName." (hr_start,hr_finish) VALUES(:hr_start,:hr_finish);";
                
                $parameters['hr_start']=$turn->getHrStart();
                $parameters['hr_finish']=$turn->getHrFinish();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query,$parameters);
            } catch (Exception $ex) {
                
                throw $ex;
            }
        }
        

        public function verify()
        {
            $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
            $query = 'SELECT * FROM '.$this->tableName;
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);
                foreach($result as $row){
                    $horaFinish= $row['hr_finish'];
                    $fecha_entrada = strtotime($horaFinish);
            //$fecha_entrada = strtotime("19-11-2008 21:00:00");
            var_dump($fecha_actual);
            var_dump($fecha_entrada);
            if($fecha_actual > $fecha_entrada)
	        {
	            echo "La fecha actual es mayor a la comparada.";
	        }else
		    {
		        echo "La fecha comparada es igual o menor";
		    }   
            }}


        public function VerifyTurn($hrStart){
        try{
            var_dump($hrStart);
            $hrStar2='00: 00: 00';

            //settype($hrStar2, 'time'); 
            var_dump($hrStar2);
            //var_dump($today);
                $query = 'SELECT * FROM '.$this->tableName;
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);
                foreach($result as $row){
                    $horaFinish= $row['hr_finish'];
                    //$diff = $date1->diff($date2);

                    var_dump($horaFinish);
                    //settype($horaFinish, 'time'); 
                    var_dump($horaFinish);
                    //var_dump($horaFinish);
                    //$result=$hrStart-$horaFinish;
                    //var_dump($result);
                    if($today>$horaFinish)
                    {
                        $result=$today-$horaFinish;
                        /*if($result>=15)
                        {
                            $verific=true;
                        }*/
                        var_dump($result);
                    }
                    else {
                        $verific=false;
                    }
                }
                return $verific; 
            } catch(Exception $ex){
                throw $e;
            }
        }

} 
=======

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

>>>>>>> Rodrigo
?>