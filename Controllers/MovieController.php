<?php namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use Models\Gender as Gender;
    use Models\Movie as Movie;

    use DAO\ApiDAO as ApiDAO;


    class MovieController{
        private $movieDAO;
        private $apiDAO;


        public function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->apiDAO = new ApiDAO();
        }
        public function ShowListView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $movieList = $this->movieDAO->GetAll();
            require_once(VIEWS_PATH."movie-list.php");
        }
        public function ShowListView2()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $movieList = $this->movieDAO->GetAll();
            require_once(VIEWS_PATH."showings-adds.php");
        }
        public function ShowListView3()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $movieList = $this->movieDAO->GetAll();
            require_once(VIEWS_PATH."movie-list2.php");
        }

        public function SaveDataBD(){
            $decodeMovie = $this->apiDAO->RetrieveDataMovie();
            var_dump($decodeMovie);
            foreach($decodeMovie['results'] as $movie){
                $result=$this->movieDAO->checkIfExist($movie['id']);
                if($result==null)
                {
<<<<<<< HEAD
                    //$insert= new Movie($movie['id'],$movie['runtime'],$movie['title'],$movie['poster_path'],$movie['original_language']);
                    $insert= new Movie($movie['id'],null,$movie['title'],$movie['poster_path'],$movie['original_language']);
                    $result2 = $this->apiDAO->RetrieveDataMovie2($result['id']);
                    //var_dump ($movie['runtime']);
                    foreach($result2['results'] as $movie){

                        $insert->setBudget($movie['runtime']);
                    }
                    //var_dump ($insert);
                    //var_dump($insert->runtime);
=======
                    $url = API."/".$movie['id'].KEY;
                    $result2 = $this->apiDAO->RetrieveDataMovie2($url);
                    $insert= new Movie($movie['id'],$result2["runtime"],$movie['title'],$movie['poster_path'],$movie['original_language']);
>>>>>>> Rodrigo
                    $this->movieDAO->Add($insert);
                    foreach ($movie['genre_ids'] as $value) {
                    $this->movieDAO->AddGxM($insert->getId(),$value);
                 }
                }
          }
          echo '<script language="javascript">alert("THE DATA BASE WAS UPDATE");</script>';
            $this->ShowListView();

        }

    }

?>
$decodeMovie = $this->apiDAO->RetrieveDataMovie();

foreach($decodeMovie['results'] as $movie){
    $result=$this->movieDAO->checkIfExist($movie['id']);
    if($result==null)
    {
        $result2 = $this->apiDAO->RetrieveDataMovie2($result['id']);
        $insert= new Movie($movie['id'],rand(100,150),$movie['title'],$movie['poster_path'],$movie['original_language']);
        $this->movieDAO->Add($insert);
        foreach ($movie['genre_ids'] as $value) {
        $this->movieDAO->AddGxM($insert->getId(),$value);
     }
    }
}