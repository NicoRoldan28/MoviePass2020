<?php namespace DAO;

use Models\Movie as Movie;
use Models\Cine as Cine;
use Models\Gender as Gender;

//use DAO\IGenderDAO as IGenderDAO;
use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\QueryType as QueryType;
use DAO\IDAO as IDAO;


class MovieDAO implements IDAO{

    private $connection;
    private $tableName = 'Movies';
    private $tableName2 = 'GendersXMovies';

        public function GetAll(){
            try {
                $movieList = array();
                $query = 'SELECT * FROM '.$this->tableName;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $row){
                    $movie= new Movie($row['id_Movie'],$row['runtime'],$row['title_Movie'],$row['image'],$row['lenguage']);
        
                    array_push($movieList,$movie);
                }
                return $movieList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }


        
        public function Add(Movie $movie){
            try {
                $query = 'INSERT INTO '.$this->tableName." (id_Movie,title_Movie,image,runtime ,lenguage) VALUES(:id_Movie,:title_Movie,:image,:runtime,:lenguage);";

                $parameters['id_Movie']=$movie->getId();
                $parameters['title_Movie']=$movie->getTitle();
                $parameters['image']=$movie->getImage();
                $parameters['runtime']=$movie->getBudget();
                //echo($parameters->lenght);
                $parameters['lenguage']=$movie->getLenguage();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query,$parameters);
            } catch (Exception $ex) {
                
                throw $ex;
            }
        }

        public function AddGxM($idmovie,$idgender){
            try {
                $query = 'INSERT INTO '.$this->tableName2." (id_Gender,id_Movie) VALUES(:id_Gender,:id_Movie);";

                $parameters['id_Gender']=$idgender;
                $parameters['id_Movie']=$idmovie;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query,$parameters);
            } catch (Exception $ex) {
                
                throw $ex;
            }
        }

        public function checkIfExist($idMovie){
            try{
                 $query = "SELECT ifnull(m.id_Movie,'a') as id from ".$this->tableName." m
                 WHERE (m.id_Movie = :idMovie);";
                 $parameters["idMovie"] = $idMovie;
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