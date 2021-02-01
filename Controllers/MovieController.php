<?php
namespace Controllers;

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
        
        foreach($decodeMovie['results'] as $movie){
            $result=$this->movieDAO->checkIfExist($movie['id']);
            if($result==null)
            {
                $url = API."/".$movie['id'].KEY;
                $result2 = $this->apiDAO->RetrieveDataMovie2($url);
                $insert= new Movie();
                $insert->setId($movie['id']);
                $insert->setLenght($result2["runtime"]);
                $insert->setTitle($movie['title']);
                $insert->setImage($movie['poster_path']);
                $insert->setLenguage($movie['original_language']);
                $this->movieDAO->Add($insert);
                foreach ($movie['genre_ids'] as $value) {
                $this->movieDAO->AddGxM($insert->getId(),$value);
             }
            }
      }
      echo '<script language="javascript">alert("THE DATA BASE WAS UPDATE");</script>';
        $this->ShowListView();

    }

    public function ConsultSold($dayTimeStart,$dayTimeFinish){
        $x=0;
        $movieList=array();
        $total=array();
        $movieList= $this->movieDAO->GetAllForShowingActivas();
        foreach($movieList as $movie)
        {
         array_push($total,$this->movieDAO->getSold($movie->getId(),$dayTimeStart,$dayTimeFinish));

        }
        require_once(VIEWS_PATH."movie-listWithTotal.php");
        
    }

}
 
?>
