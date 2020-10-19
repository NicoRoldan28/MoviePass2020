<?php namespace Controllers;

    use DAO\GenderDAO as GenderDAO;
    use Models\Gender as Gender;

    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;

    use DAO\ApiDAO as ApiDAO;


    class GenderController{
        private $genderDAO;
        private $movieDAO;
        private $apiDAO;

        public function __construct()
        {
            $this->genderDAO = new GenderDAO();
            $this->movieDAO = new MovieDAO();
            $this->apiDAO = new ApiDAO();
        }
        public function ShowListView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $genderList = $this->genderDAO->GetAll();
            //require_once(VIEWS_PATH."gender-list.php");
        }

        public function SaveDataBD(){
            
            $decodeGender = $this->apiDAO->RetrieveDataGender();
            foreach($decodeGender['genres'] as $gender){
            
                if($this->genderDAO->checkIfExist($gender['id'])==null){
                    $insertGe = new Gender($gender['id'],$gender['name']);
                    //var_dump($insertGe);
                    $this->genderDAO->AddGender($insertGe);
                }
                //$algo=$this->genderDAO->checkIfExist($gender['id']);
//                var_dump ($algo);

          }
          echo '<script language="javascript">alert("THE DATA BASE WAS UPDATE");</script>';
        $this->ShowListView();

        }
        public function ShowListViewForSelect()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $genderList = $this->genderDAO->GetAll();
            require_once(VIEWS_PATH."selectGender.php");
        }

        /*public function selectGender($name){
          
            $movieList=array();
            $movieList2=array();
            $movieList3=array();
            $movie= new Movie(0,0,0,0,0);
            $gender=$this->genderDAO->returnId($name);

            //var_dump($gender);
            $movieList=$this->genderDAO->newwww($gender);
            $movieList2=$this->genderDAO->nosexd($movieList);

            //var_dump($movieList2);
            //$movieList2=$this->genderDAO->xdxxdxdxdd($movieList);

            /*foreach($movieList2 as $value)
            {   
                var_dump($value);
                $movie=$this->movieDAO->returnMovieXid($value);
                array_push($movieList3,$movie);
            }
            var_dump($movieList3);
            require_once(VIEWS_PATH."movie-list2.php");
        }*/
    }

?>