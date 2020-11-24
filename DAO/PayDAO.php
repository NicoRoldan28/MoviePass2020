<?php namespace DAO;

    use Models\Pay as Pay;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;

    class PayDAO
    {
        private $tableName = 'paytc';

        public function AcreditPay(Pay $pay,$idBuy){
            try
            {
                $procedure = 'call AcreditePay(:days,:total,:idBuy);';
                $parameters["days"]=$pay->getDate();
                $parameters["total"]=$pay->getTotal();
                $parameters["idBuy"]=$idBuy;
    
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($procedure, $parameters);

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
                    $buy->setQuantityTicket($row["quantity_ticket"]);
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
    }
    
?>