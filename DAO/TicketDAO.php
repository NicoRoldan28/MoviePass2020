<?php namespace DAO;

    use Models\Ticket as Ticket;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;

    class TicketDAO
    {
        private $tableName = 'ticket';

        public function Add(Ticket $ticket){

            try {
                $query = 'INSERT INTO '.$this->tableName." (id_Showing,id_Buy) VALUES(:id_Showing,:id_Buy);";

                $parameters['id_Showing']=$ticket->getShowing()->getIdShowing();
                $parameters['id_Buy']=$ticket->getBuy()->getIdBuy();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query,$parameters);
            } catch (Exception $ex) {
                
                throw $ex;
            }
        }

        public function GetAll(){
            try {
                $ticketList = array();
                $query = 'SELECT * FROM '.$this->tableName;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $row){
                    $ticket= new Ticket();
                    $ticket->setIdTicket($row['nro_entrada']);
                    $ticket->setShowing();
                    $ticket->getShowing()->setIdShowing($row['id_Showing']);

                    $ticket->setBuy();
                    $ticket->getBuy()->setIdBuy($row['id_Buy']);
        
                    array_push($ticketList,$ticket);
                }
                return $ticketList;
                } catch (Exception $ex) {
                    throw $ex;
                }

        }

        public function GetAllTicketByIdBuy($id){
            try {
                $ticketList = array();
                $procedure = 'call GetAllTicketByIdBuy(:id);';
                $parameters['id']=$id;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($procedure,$parameters);
                //var_dump($result);
                foreach($result as $row){


                    $ticket = new Ticket();
                    $ticket->setIdTicket($row['nro_entrada']);
                    $ticket->setShowing();
                    $ticket->getShowing()->setDayTime($row['day']);
                    $ticket->setBuy();
                    $ticket->getBuy()->setIdBuy($row['id_Buy']);
                    $ticket->getShowing()->setRoom();
                    $ticket->getShowing()->getRoom()->setCinema();
                    $ticket->getShowing()->getRoom()->getCinema()->setName($row['name']);
                    $ticket->getShowing()->getRoom()->setNombre($row['nombre']);
                    $ticket->getShowing()->setMovie();
                    $ticket->getShowing()->getMovie()->setTitle($row['title_Movie']);

                    array_push($ticketList,$ticket);
                }
                return $ticketList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }

        public function GetNumberTicketByIdBuy($id){
            try {
                $ticketList = array();
                $procedure = 'call GetNumberTicketByIdBuy(:id);';
                $parameters['id']=$id;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($procedure,$parameters);
                //var_dump($result);
                foreach($result as $row){


                    $ticket = new Ticket();
                    $ticket->setIdTicket($row['nro_entrada']);

                    array_push($ticketList,$ticket);
                }
                return $ticketList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }

        public function getTicketByIdBuy($id)
        {
            try {
                $ticketList = array();
                var_dump($id);
                $procedure = 'call GetAllTicketByIdBuy(:id);';
                $parameters['id']=$id;

                /* 
            $query = 'SELECT s.id_Showing, s.day, s.idMovie, s.idRoom, s.hrFinish, r.id_Cine from '.$this->tableName.' as s 
            inner join room r on r.idRoom = s.idRoom WHERE(s.idMovie = :idMovie);';

            $parameters["idMovie"] = $idMovie;
                */

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($procedure,$parameters);
                var_dump($result);
                return $result;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }

        public function GetAllByIdUser($id,$idBuy){
            try {
                $ticketList = array();
                $procedure = 'call GetAllByIdUser(:id,:idBuy);';
                $parameters['id']=$id;
                $parameters['idBuy']=$idBuy;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($procedure,$parameters);
                foreach($result as $row){


                    $ticket = new Ticket();
                    $ticket->setIdTicket($row['nro_entrada']);
                    $ticket->setShowing();
                    $ticket->getShowing()->setDayTime($row['day']);
                    $ticket->setBuy();
                    $ticket->getBuy()->setIdBuy($row['id_Buy']);
                    $ticket->getShowing()->setRoom();
                    $ticket->getShowing()->getRoom()->setCinema();
                    $ticket->getShowing()->getRoom()->getCinema()->setName($row['name']);
                    $ticket->getShowing()->getRoom()->setNombre($row['nombre']);
                    $ticket->getShowing()->setMovie();
                    $ticket->getShowing()->getMovie()->setTitle($row['title_Movie']);

                    //var_dump($ticket);
                    array_push($ticketList,$ticket);
                }
                return $ticketList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }



       
        public function CheckAvailability($idShowing){
            try {
            
                $procedure = 'call CheckAvailability(:idShowing);';
    
                $parameters["idShowing"] = $idShowing;
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($procedure,$parameters);
                
                return $result[0]["AVAILABILITY"];
                } catch (Exception $ex) {
                    throw $ex;
                }
            }
    }
    
?>