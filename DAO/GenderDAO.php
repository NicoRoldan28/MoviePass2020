<?php namespace DAO;
    use Models\Gender as Gender;
    use DAO\IGenderDAO as IGenderDAO;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Models\Movie as Movie;
    use DAO\MovieDAO as MovieDAO;

    class GenderDAO implements IGenderDAO{

        private $connection;
        private $tableName = 'Genders';
        private $tableName2 = 'GendersXMovies';
        private $tableName3= 'Movies';

        public function GetAll(){
            try {
                $genderList = array();
                $query = 'SELECT * FROM '.$this->tableName;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $row){
                    $gender= new Gender($row['id_Gender'],$row['name_Gender']);
        
                    array_push($genderList,$gender);
                }
                return $genderList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }

        public function AddGender(Gender $gender){
            try {
                $query = 'INSERT INTO '.$this->tableName." (id_Gender,name_Gender) VALUES(:id_Gender,:name_Gender);";

                $parameters['id_Gender']=$gender->getId();
                $parameters['name_Gender']=$gender->getName();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query,$parameters);
            } catch (Exception $ex) {
                
                throw $ex;
            }
        }

        public function checkIfExist($idGender){
            try{
                 $query = "SELECT ifnull(g.id_Gender,'a') as id from ".$this->tableName." g
                 WHERE (g.id_Gender = :idGender);";
                 $parameters["idGender"] = $idGender;
                
                 $this->connection = Connection::GetInstance();
     
                 $results=$this->connection->Execute($query, $parameters);
                 
                 return($results);
                 }
                 catch(Exception $e)
                 {
                     throw $e;
                 }
        }

    }
?>