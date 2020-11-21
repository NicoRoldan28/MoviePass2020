<?php namespace DAO;

    use Models\Buy as Buy;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;

    class BuyDAO
    {
        private $tableName = 'buy';

        public function Add(Buy $buy){
            try
            {
                $procedure = 'call CargarBuy(:id_User,:quantityTickets,:discount,:days,:total);';
                $parameters["id_User"]=$buy->getUser()->getId();
                $parameters["quantityTicket"]=$buy->getQuantityTickets();
                $parameters["discount"]=$buy->getDiscount();
                $parameters["days"]=$buy->getDate();
                $parameters["total"]=$buy->getTotal();
                $parameters["quantityTickets"]=$buy->getQuantityTicket();
    
                $this->connection = Connection::GetInstance();
                $result= $this->connection->Execute($procedure, $parameters);
                return $result[0]['id_Buyticket'];

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll(){
            try
            {
                $buyList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $buy = new Buy();
                    
                    $buy->setUser();
                    $buy->getUser()->setId($row["id_User"]);
                    $buy->setIdBuy($row["id_Buy"]);
                    $buy->setQuantityTicket($row["quantityTickets"]);
                    $buy->setDate($row["days"]);
                    $buy->setDiscount($row["discount"]);
                    $buy->getTotal($row["total"]);
                    array_push($buyList, $buy);
                }

                return $buyList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        public function GetAllByUser($idUser){
            try
            {
                $buyList = array();
                $procedure = 'call GetAllByIdUser(:id);';
                $parameters['id']=$id;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($procedure,$parameters);
                
                foreach ($resultSet as $row)
                {                
                    $buy = new Buy();
                    
                    $buy->setUser();
                    $buy->getUser()->setId($row["id_User"]);
                    $buy->setIdBuy($row["id_Buy"]);
                    $buy->setQuantityTicket($row["quantityTickets"]);
                    $buy->setDate($row["days"]);
                    $buy->setDiscount($row["discount"]);
                    $buy->setTotal($row["total"]);
                    array_push($buyList, $buy);
                }

                return $buyList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        public function GetLastBuy($idUser)
        {
            try
            {
                $query = "SELECT b.id_Buy FROM ".$this->tableName." b where b.id_User = :idUser
                order by b.id_Buy desc limit 1;";
                $parameters['idUser'] = $idUser;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query,$parameters);
                foreach ($resultSet as $row)
                {                
                    $idbuy = $row["id_Buy"];
                }
                
                return $idbuy;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            
            
        }

        public function GetBuyForId($id)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName." b where b.id_Buy = :id;";
                $parameters['id'] = $id;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query,$parameters);
                foreach ($resultSet as $row)
                {                
                    $buy = new Buy();
                    $buy->setUser();
                    $buy->getUser()->setId($row["id_User"]);
                    $buy->setIdBuy($row["id_Buy"]);
                    $buy->setQuantityTicket($row["quantityTickets"]);
                    $buy->setDate($row["days"]);
                    $buy->setDiscount($row["discount"]);
                    $buy->setTotal($row["total"]);
                }
                
                return $buy;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }  
    }
?>