<?php namespace DAO;

use Models\Movie as Movie;
use Models\Cine as Cine;
use Models\Gender as Gender;

//use DAO\IGenderDAO as IGenderDAO;
use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\QueryType as QueryType;

class MovieDAO{

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
                    $movie= new Movie($row['id_Movie'],$row['lenght'],$row['title_Movie'],$row['image'],$row['lenguage']);
        
                    array_push($movieList,$movie);
                }
                return $movieList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }

        public function GetAllShowings(){
            try {
                $movieList = array();
                $query = 'SELECT * FROM '.$this->tableName.' m inner join Showings s on s.idMovie = m.id_Movie group by s.idMovie';

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $row){
                    $movie= new Movie($row['id_Movie'],$row['lenght'],$row['title_Movie'],$row['image'],$row['lenguage']);
        
                    array_push($movieList,$movie);
                }
                return $movieList;
                } catch (Exception $ex) {
                    throw $ex;
                }
        }
        
        public function Add(Movie $movie){
            try {
                $query = 'INSERT INTO '.$this->tableName." (id_Movie,title_Movie,image,lenght,lenguage) VALUES(:id_Movie,:title_Movie,:image,:lenght,:lenguage);";

                $parameters['id_Movie']=$movie->getId();
                $parameters['title_Movie']=$movie->getTitle();
                $parameters['image']=$movie->getImage();
                $parameters['lenght']=$movie->getLenght();
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

        public function returnId($nombre)
        {
            try{
           $movie = null;

            //$query = "SELECT nombre, capacidad, direccion, valor_entrada FROM ".$this->tableName."WHERE (nombre = :nombre)";
            $query = "SELECT * FROM ".$this->tableName. " WHERE (title_Movie = :nombre)";
            $parameters["nombre"] = $nombre;

            $this->connection = Connection::GetInstance();

            $results=$this->connection->Execute($query, $parameters);
            //var_dump ($results);
            
            foreach($results as $row)
            {
                $movie=new Movie(0,0,0,0,0,0);

                $movie->setId($row["id_Movie"]);
                //$cine->setName($row["namee"]);
                //$cine->setCapacity($row["capacity"]);
                //$cine->setAddress($row["addres"]); 
                //$cine->setPrice_ticket($row["price_ticket"]);

            }
            $i=$movie->getId();
            //echo($cine->getId());
            return $i;
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        public function returnName($id)
        {
            try{
           $movie = null;

            //$query = "SELECT nombre, capacidad, direccion, valor_entrada FROM ".$this->tableName."WHERE (nombre = :nombre)";
            $query = "SELECT * FROM ".$this->tableName. " WHERE (id_movie = :id)";
            $parameters["id"] = $id;

            $this->connection = Connection::GetInstance();

            $results=$this->connection->Execute($query, $parameters);
            //var_dump ($results);
            
            foreach($results as $row)
            {
                $movie=new Movie(0,0,0,0,0,0);

                $movie->setTitle($row["title_Movie"]);
                //$cine->setName($row["namee"]);
                //$cine->setCapacity($row["capacity"]);
                //$cine->setAddress($row["addres"]); 
                //$cine->setPrice_ticket($row["price_ticket"]);

            }
            $i=$movie->getTitle();
            //echo($i);
            return $i;
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }
        public function returnMovieXid($id)
        {
            try{
           //$movie = null;

            //$query = "SELECT nombre, capacidad, direccion, valor_entrada FROM ".$this->tableName."WHERE (nombre = :nombre)";
            $query = "SELECT * FROM ".$this->tableName. " WHERE (id_movie = :id)";
            $parameters["id"] = $id;

            $this->connection = Connection::GetInstance();

            $results=$this->connection->Execute($query, $parameters);
            //var_dump ($results);
            
            foreach($results as $row)
            {
                $movie2=new Movie(0,0,0,0,0,0);
                $movie2->setId($row["id_Movie"]);
                $movie2->setTitle($row["title_Movie"]);
                $movie2->setLenght($row["lenght"]);
                $movie2->setImage($row["image"]);
                $movie2->setLenguage($row["lenguage"]);

            }
            //$i=$movie->getTitle();
            //echo($cine->getId());
            return $movie2;
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        public function returnMovie(Movie $movie)
        {
            try{
           //$movie = null;

            //$query = "SELECT nombre, capacidad, direccion, valor_entrada FROM ".$this->tableName."WHERE (nombre = :nombre)";
            $query = "SELECT * FROM ".$this->tableName. " WHERE (id_movie = :id)";
            $parameters["id"] = $movie->getId();

            $this->connection = Connection::GetInstance();

            $results=$this->connection->Execute($query, $parameters);
            //var_dump ($results);
            
            foreach($results as $row)
            {
                $movie2=new Movie(0,0,0,0,0,0);
                $movie2->setId($row["id_Movie"]);
                $movie2->setTitle($row["title_Movie"]);
                $movie2->setLenght($row["lenght"]);
                $movie2->setImage($row["image"]);
                $movie2->setLenguage($row["lenguage"]);

            }
            //$i=$movie->getTitle();
            //echo($cine->getId());
            return $movie2;
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        /*public function checkId($id){
            try{
                $query = "SELECT * FROM ".$this->tableName. " WHERE (id_movie = :id)";
                 $parameters["id"] = $movie->getId();
     
                 $this->connection = Connection::GetInstance();
     
                 $results=$this->connection->Execute($query, $parameters);
                 //var_dump ($results);
                 
                 foreach($results as $row)
                 {
                     $movie2=new Movie(0,0,0,0,0,0);
                     $movie2->setId($row["id_Movie"]);
                     $movie2->setTitle($row["title_Movie"]);
                     $movie2->setLenght($row["lenght"]);
                     $movie2->setImage($row["image"]);
                     $movie2->setLenguage($row["lenguage"]);
     
                 }
                 //$i=$movie->getTitle();
                 //echo($cine->getId());
                 return $movie2;
                 }
                 catch(Exception $e)
                 {
                     throw $e;
                 }

        }*/

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