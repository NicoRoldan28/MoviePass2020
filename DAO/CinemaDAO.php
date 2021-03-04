<?php 

    namespace DAO;
    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class CinemaDAO{

        private $connection;
        private $tableCinemas = "cinemas";
        private $tableRooms = "rooms";

        public function Add(Cinema $cinema){

            try
            {
                $query1 = "INSERT INTO ".$this->tableCinemas."(adress,name) 
                VALUES (:adress,:name)";

                $parameters["adress"] = $cinema->getAdress();
                $parameters["name"] = $cinema->getName();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query1,$parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll(){
            try
            {
                $cineList = array();
                $query = "SELECT * FROM ".$this->tableCinemas;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $cinema = new Cinema();
            
                    $cinema->setId($row["id_cinema"]);
                    $cinema->setName($row["name"]);
                    $cinema->setAdress($row["adress"]);
                    //$cinema->setPrice_ticket($row["price_ticket"]);
                    
                    array_push($cineList, $cinema);
                }

                return $cineList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        public function getCinemaById($id_cinema){
            try
            {
                $query = "SELECT * FROM ".$this->tableCinemas." WHERE (id_cinema = :id_cinema)";

                $parameters["id_cinema"] = $id_cinema;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query,$parameters);
                
                foreach ($resultSet as $row)
                {                
                    $cinema = new Cinema();
            
                    $cinema->setId($row["id_cinema"]);
                    $cinema->setAdress($row["adress"]);
                    $cinema->setName($row["name"]);
                    //$cinema->setPrice_ticket($row["price_ticket"]);
                }

                return $cinema;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        public function getCinemaByName($name){
            try
            {
                $query = "SELECT * FROM ".$this->tableCinemas." WHERE (name = :name)";

                $parameters["name"] = $name;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query,$parameters);
                
                foreach ($resultSet as $row)
                {                
                    $cinema = new Cinema();
            
                    $cinema->setId($row["id_cinema"]);
                    $cinema->setAdress($row["adress"]);
                    $cinema->setName($row["name"]);
                    //$cinema->setPrice_ticket($row["price_ticket"]);
                }

                return $cinema;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        public function seachCinema($name,$adress){
            try
            {
                $query = "SELECT name, adress FROM ".$this->tableCinemas." WHERE (name = :name)||(adress = :adress)";

                $parameters["name"] = $name;
                $parameters["adress"] = $adress;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query,$parameters);
                $cinema=null;
                foreach ($resultSet as $row)
                { 
                    $cinema = new Cinema();               
                    $cinema->setAdress($row["adress"]);
                    $cinema->setName($row["name"]);
                }
                if($cinema==null){
                   $verific=false; 
                }else{
                    $verific=true;
                }  
                return $verific;
            } catch (Exception $th) {
                throw $th;
            } 
        }

        public function AddRoom(Room $room,$id_cinema){
            try
            {
                $procedure = "call CargarRoomCinema(:nombre,:capacidad,:id);";

                $parameters["nombre"] = $room->getNombre();
                $parameters["capacidad"] = $room->getCapacidad();
                $parameters["id"] = $id_cinema;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($procedure,$parameters);  
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        
        }

        public function getAllRoomsXCine($id_cinema){
            try
            {
                $roomsList = array();
                $query = "SELECT * FROM ".$this->tableRooms." r inner join".$this->tableCinemas." c ON c.id_cinema = r.id_Cine
                where c.id_cinema = :id_cinema;";
                $parameters["id_cinema"] = $id_cinema;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query,$parameters);
                var_dump($resultSet);
                /*foreach ($resultSet as $row)
                {                
                    $cinema = new Cinema();
            
                    $cinema->setId($row["id_cinema"]);
                    $cinema->setName($row["name"]);
                    $cinema->setAdress($row["adress"]);
                    $cinema->setPrice_ticket($row["price_ticket"]);
                    
                    array_push($cineList, $cinema);
                }*/

                //return $cineList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getSold($id_cinema,$dayTimeStart,$dayTimeFinish){
            try{
                $procedure = "call CountMoneyForCinema(:id,:dayS,:dayF);";
                $parameters["id"] = $id_cinema;
                $parameters["dayS"] = $dayTimeStart;
                $parameters["dayF"] = $dayTimeFinish;
                $this->connection = Connection::GetInstance();
                $result=$this->connection->Execute($procedure,$parameters);
                return $result[0]["sum(ta.total)"];
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
}

?>