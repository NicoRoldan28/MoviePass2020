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
            require_once(VIEWS_PATH."gender-list.php");
        }

        public function ShowListSelectGenderView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $genderList = $this->genderDAO->GetAll();
            require_once(VIEWS_PATH."gender-select.php");
        }
        public function SaveDataBD(){
            
            $decodeGender = $this->apiDAO->RetrieveDataGender();
            foreach($decodeGender['genres'] as $gender){
                $result=$this->genderDAO->checkIfExist($gender['id']);
                if($result==null){
                    $insertGe = new Gender($gender['id'],$gender['name']);
                    //var_dump($insertGe);
                    $this->genderDAO->AddGender($insertGe);
                }

          }
          echo '<script language="javascript">alert("THE DATA BASE WAS UPDATE");</script>';
        $this->ShowListView();

        }

        

        
    }

?>