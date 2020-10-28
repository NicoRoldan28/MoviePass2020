<?php namespace DAO;

use Models\Room as Room;
use Models\Cinema as Cinema;

//use DAO\IGenderDAO as IGenderDAO;
use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\QueryType as QueryType;
use DAO\CinemaDAO as CinemaDAO;


class RoomDAO implements IDAO{

    private $connection;
    private $tableName = 'Room';
    
    public function GetAll(){
        try {
            $roomList = array();
            $query = 'SELECT * FROM '.$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row){
                $room= new Room($row['idRoom'],$row['nombre'],$row['capacidad'],$row['id_Cine']);
    
                array_push($roomList,$room);
            }
            return $roomList;
            } catch (Exception $ex) {
                throw $ex;
            }
    }

    public function Add(Room $room){
        try {
            $query = 'INSERT INTO '.$this->tableName." (nombre,capacidad,id_Cine) VALUES(:nombre,:capacidad,:id_Cine)";

            $parameters['nombre']=$room->getNombre();
            $parameters['capacidad']=$room->getCapacidad();
            $parameters['id_Cine']=$room->getCinema()->getId();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function seachRoom($name,$idCine){
        try
        {
            $query = "SELECT nombre, id_Cine FROM ".$this->tableName." WHERE (nombre = :nombre)&&(id_Cine = :id_Cine)";

            $parameters["nombre"] = $name;
            $parameters["id_Cine"] = $idCine;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query,$parameters);
            $room=null;
            foreach ($resultSet as $row)
            { 
                $room = new Room();               
                $room->setNombre($row["nombre"]);
            }
            if($room==null){
               $verific=false; 
            }else{
                $verific=true;
            }  
            return $verific;
        } catch (Exception $th) {
            throw $th;
        } 
    }
}

?>