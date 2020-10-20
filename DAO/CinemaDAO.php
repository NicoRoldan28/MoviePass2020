<?php 

    namespace DAO;
    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;

    use \Exception as Exception;
    use DAO\Connection as Connection;

    class CinemaDAO implements ICinemaDAO{

        private $connection;
        private $tableCinemas = "cinemas";

        public function Add(Cinema $cinema){

            try
            {
                $query1 = "INSERT INTO ".$this->tableCinemas."(adress,name,price_ticket) 
                VALUES (:adress,:name,:price_ticket)";

                $parameters["adress"] = $cinema->getAdress();
                $parameters["name"] = $cinema->getName();
                $parameters["price_ticket"] = $cinema->getPrice_ticket();

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
                    $cinema->setPrice_ticket($row["price_ticket"]);
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
                    $cinema->setPrice_ticket($row["price_ticket"]);
                }

                return $cinema;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

    }

?>