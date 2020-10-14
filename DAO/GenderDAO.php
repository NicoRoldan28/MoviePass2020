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

        public function GetForGender($name){
            try{
                $genderList = array();
                echo $name;

                $query = "SELECT * FROM ".$this->tableName. " WHERE (name_Gender = :name)";

                $parameters["name"] = $name;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->ExecuteNonQuery($query,$parameters);

                foreach($result as $row){

                    $gender= new Gender($row['id_Gender'],$row['name_Gender']);
        
                    array_push($genderList,$gender);
                }

                return $genderList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function returnId($nombre)
        {
            try{
            $gender = null;

            $query = "SELECT * FROM ".$this->tableName. " WHERE (name_Gender = :nombre)";
            $parameters["nombre"] = $nombre;

            $this->connection = Connection::GetInstance();

            $results=$this->connection->Execute($query, $parameters);
            //var_dump ($results);
            
            foreach($results as $row)
            {
                $gender=new Gender(0,0);

                $gender->setId($row["id_Gender"]);
                $gender->setName($row["name_Gender"]);
                //$cine->setName($row["namee"]);
                //$cine->setCapacity($row["capacity"]);
                //$cine->setAddress($row["addres"]); 
                //$cine->setPrice_ticket($row["price_ticket"]);

            }
            return $gender->getId();
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }


        public function newwww($id) //IMPORTANTEEEEEEE
        {
            $listId=array();
            $movie= new Movie(0,0,0,0,0);
            $listMovie=array();

            $query = "SELECT * FROM ".$this->tableName2. " WHERE (id_Gender = :id)"; //GendersXMovies
            $parameters["id"]= $id;

            $this->connection = Connection::GetInstance();

            $results=$this->connection->Execute($query, $parameters);
            //var_dump($results);

            foreach($results as $row){
                $movie->setId($row["id_Movie"]);
                array_push($listId,$movie->getId());
            }
            //echo($results);
            /*foreach($results as $row)
            {
                //$idMovie=$row["id_Movie"];
                //$listId=$row["id_Movie"];
                //array_push($listId,$value);
                
                //var_dump($value);
                //$idsMovie=$value;
                $movie->setId($row["id_Movie"]);
                //var_dump($movie->getId());
                $idddd=$movie->getId();
               // echo($idddd);

                //$query = "SELECT * FROM ".$this->tableName3. " WHERE (id_Movie = :id_Moviedd)";      //Movies
                //$query2= "SELECT * FROM ".$this->tableName3. " WHERE (id_Movie = :id_Moviedd)";      //Movies
                $query="SELECT id_Movie FROM ".$this->tableName3. " WHERE ( id_Movie =  :id )";
                $parameters["id"]=$movie->getId();

                $this->connection = Connection::GetInstance();
                //echo $query;
                //var_dump ($parameters);
                //var_dump($movie->getId());
                $results=$this->connection->Execute($query,$parameters);
                //var_dump($results);
                foreach($results as $row)
                {
                   $movie->setId($idddd);
                   var_dump($movie);
                   array_push($listMovie,$movie);
                   echo("listaaaa");
                   var_dump($listMovie);
                }
                
            }*/
            //var_dump($listId);
            return $listId;

        }

        public function nosexd($listId) ///IMPORTANTEEEEEEE
        {
            //$movie2= new Movie(0,0,0,0,0);
            $listMovie=array();
            //var_dump($listId);

            foreach($listId as $value)
            {
                //var_dump ($value);

                $query = "SELECT * FROM ".$this->tableName3. "  m inner join Showings s on s.idMovie = m.id_Movie WHERE (id_Movie = :value)";
                $parameters["value"]=$value;
                //echo($value);
                $this->connection = Connection::GetInstance();
                $results=$this->connection->Execute($query,$parameters);
                foreach ($results as $row)
                {
                   // var_dump($listMovie);
                    /*$movie2->setId($row["id_Movie"]);
                    $movie2->setTitle($row["title_Movie"]);
                    $movie2->setLenght($row["lenght"]);
                    $movie2->setImage($row["image"]);
                    $movie2->setLenguage($row["lenguage"]);*/

                    $movie2= new Movie($row['id_Movie'],$row['lenght'],$row['title_Movie'],$row['image'],$row['lenguage']);
                    //var_dump($movie2);
                   // var_dump($row);
                    array_push($listMovie,$movie2);
                }
                //var_dump ($results);
                //var_dump($listMovie);
            }

           // var_dump($listMovie);
             return $listMovie;
        }


        public function returnMovieXGender($id)
        {
           // try{
                //buscamos el id de la pelicula en la tabla de generoXpelicula
                //$listMovie=array();
                $listId=array();
                //$movie= new Movie(0,0,0,0,0);



                $query = "SELECT * FROM ".$this->tableName2. " WHERE (id_Gender = :id)";
                $parameters["id"]= $id;

                $this->connection = Connection::GetInstance();

                $results=$this->connection->Execute($query, $parameters);
                //var_dump($results) ;
                foreach($results as $row)
                {
                    //$idMovie=$row["id_Movie"];
                    //$listId=$row["id_Movie"];
                    array_push($listId,$row["id_Movie"]);
                }
                //var_dump ($listId);
                return $listId;
                //retornamos las peliculas con ese id de generoXpelicula

                //if (isset($listId))
                //{
                    //foreach($listId as $value)
                   // {
                    //echo $value;
                    //$query = "SELECT * FROM ".$this->tableName3. " WHERE (id_Movie = :value)";
                    //$parameter["value"]= $value;
                
               //     $this->connection = Connection::GetInstance();
                //    $this->connection->ExecuteNonQuery($query, $parameter);
                    //foreach($result as $row)
                    //{
                      //$movie= new Movie($row['id_Movie'],$row['lenght'],$row['title_Movie'],$row['image'],$row['lenguage']);
                      //$movie->setId($value);

                      //var_dump($movie->getId());
                      /*$movie->setLenght($row['lenght']);
                      $movie->setTitle($row['title_Movie']);
                      $movie->setImage($row['image']);
                      $movie->setLenguage($row['lenguage']);*/
                      //array_push($listMovie,$movie);
                      //var_dump($listMovie);
                    //}
                    //}
                //}
                //var_dump($listMovie);

                //return $listMovie;
            //}catch(Exception $e)
              //  {
               //     throw $e;
                //}
            //}
              }
            //DIVISIONNNNNNNNNN
            public function xdxxdxdxdd($listId)
            {   
                $movie= new Movie(0,0,0,0,0);
                $listMovie=array();
                foreach($listId as $value)
                {
                    $query = "SELECT * FROM ".$this->tableName3. " WHERE (id_Movie = :value)";
                    $parameter["value"]= $value;

                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameter);
                    $movie->setId($value);

                    //var_dump($movie->getId());
                    array_push($listMovie,$movie);
                }
                var_dump($listMovie);

                return $listMovie;
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
                echo $idGender;
                 $query = "SELECT ifnull(g.id_Gender,'a') as id from ".$this->tableName." g
                 WHERE (g.id_Gender = :idGender);";
                 $parameters["idGender"] = $idGender;
                
                 $this->connection = Connection::GetInstance();
     
                 $results=$this->connection->Execute($query, $parameters);
                 
                 return($results[0]['id']);
                 //var_dump($results[0]['id']);
                 }
                 catch(Exception $e)
                 {
                     throw $e;
                 }
        }
    }
?>