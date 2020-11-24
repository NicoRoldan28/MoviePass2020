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
                $movie= new Movie(/*$row['id_Movie'],$row['lenght'],$row['title_Movie'],$row['image'],$row['lenguage']*/);
                    $movie->setId($row['id_Movie']);
                    $movie->setLenght($row['lenght']);
                    $movie->setTitle($row['title_Movie']);
                    $movie->setImage($row['image']);
                    $movie->setLenguage($row['lenguage']);
                    array_push($movieList,$movie);
                }
                return $movieList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }

        public function GetAllForShowing(){
            try {
                $movieList = array();

                $query = 'SELECT m.id_Movie, m.title_Movie, m.image, m.lenght, m.lenguage FROM '.$this->tableName. ' as m 
                inner join showings s on s.idMovie = m.id_Movie
                group by m.id_Movie;';

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $row){
                $movie= new Movie(/*$row['id_Movie'],$row['lenght'],$row['title_Movie'],$row['image'],$row['lenguage']*/);
                    $movie->setId($row['id_Movie']);
                    $movie->setLenght($row['lenght']);
                    $movie->setTitle($row['title_Movie']);
                    $movie->setImage($row['image']);
                    $movie->setLenguage($row['lenguage']);
                    array_push($movieList,$movie);
                }
                return $movieList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }

        public function GetAllForShowingActivas(){
            try {
                $movieList = array();

                $query = 'SELECT m.id_Movie, m.title_Movie, m.image, m.lenght, m.lenguage FROM '.$this->tableName. ' as m 
                inner join showings s on s.idMovie = m.id_Movie
                where s.day >= (select NOW())
                group by m.id_Movie;';

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $row){
                $movie= new Movie(/*$row['id_Movie'],$row['lenght'],$row['title_Movie'],$row['image'],$row['lenguage']*/);
                    $movie->setId($row['id_Movie']);
                    $movie->setLenght($row['lenght']);
                    $movie->setTitle($row['title_Movie']);
                    $movie->setImage($row['image']);
                    $movie->setLenguage($row['lenguage']);
                    array_push($movieList,$movie);
                }
                return $movieList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }

        public function GetAllForShowingForGender($idGender){
            try {
                $movieList = array();

                $query = 'SELECT m.id_Movie, m.title_Movie, m.image, m.lenght, m.lenguage FROM '.$this->tableName.' as m inner join showings s on s.idMovie = m.id_Movie inner join gendersxmovies gxm on gxm.id_Movie = m.id_Movie where(gxm.id_Gender = :id_Gender) group by m.id_Movie;';

                $parameters['id_Gender']=$idGender;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query,$parameters);

                foreach($result as $row){
                $movie= new Movie(/*$row['id_Movie'],$row['lenght'],$row['title_Movie'],$row['image'],$row['lenguage']*/);
                    $movie->setId($row['id_Movie']);
                    $movie->setLenght($row['lenght']);
                    $movie->setTitle($row['title_Movie']);
                    $movie->setImage($row['image']);
                    $movie->setLenguage($row['lenguage']);
                    array_push($movieList,$movie);
                }
                return $movieList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }


        
        public function Add(Movie $movie){
            try {
                $query = 'INSERT INTO '.$this->tableName." (id_Movie,title_Movie,image,lenght ,lenguage) VALUES(:id_Movie,:title_Movie,:image,:runtime,:lenguage);";

                $parameters['id_Movie']=$movie->getId();
                $parameters['title_Movie']=$movie->getTitle();
                $parameters['image']=$movie->getImage();
                $parameters['runtime']=$movie->getLenght();
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

        public function returnMovie($idMovie){
            try{
                //$movie= new Movie(null,null,null,null,null,null);
                 $query = "SELECT * FROM ".$this->tableName." WHERE (id_Movie = :id_Movie)";
                 $parameters["id_Movie"] = $idMovie;
                 $this->connection = Connection::GetInstance();
                 $results=$this->connection->Execute($query, $parameters);
                 //var_dump($results);
                 foreach($results as $row)
                 {
                    //var_dump($row['id_Movie']);
                    //$movie= new Movie($row['id_Movie'],$row['lenght'],$row['title_Movie'],$row['image'],$row['lenguage']);
                 $movie= new Movie(/*$row['id_Movie'],$row['lenght'],$row['title_Movie'],$row['image'],$row['lenguage']*/);
                    $movie->setId($row['id_Movie']);
                    $movie->setLenght($row['lenght']);
                    $movie->setTitle($row['title_Movie']);
                    $movie->setImage($row['image']);
                    $movie->setLenguage($row['lenguage']);
                 }
                 return($movie); 
                 }
                 catch(Exception $e)
                 {
                     throw $e;
                 }
        }

        public function getSold($idMovie,$dayTimeStart,$dayTimeFinish){
            try{
                $procedure = "call CountMoneyForMovie(:Valuee,:dayS,:dayF);";
                $parameters["Valuee"] = $idMovie;
                $parameters["dayS"] = $dayTimeStart;
                $parameters["dayF"] = $dayTimeFinish;
                $this->connection = Connection::GetInstance();
                $result=$this->connection->Execute($procedure,$parameters);
                return $result[0]["total"];
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        /*foreach ($resultSet as $row)
        {                
            $cinema = new Cinema();
    
            $cinema->setId($row["id_cinema"]);
            $cinema->setAdress($row["adress"]);
            $cinema->setName($row["name"]);
            $cinema->setPrice_ticket($row["price_ticket"]);
        }*/

}

?>