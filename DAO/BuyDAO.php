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
                $procedure = 'call CargarBuy(:id_User,:discount,:days,:total);';
                $parameters["id_User"]=$buy->getUser()->getId();
                $parameters["discount"]=$buy->getDiscount();
                $parameters["days"]=$buy->getDate();
                $parameters["total"]=$buy->getTotal();
    
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
                    //$buy->setQuantityTicket($row["quantity_ticket"]);
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
                    //$buy->setQuantityTicket($row["quantity_ticket"]);
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
    }
    
?>