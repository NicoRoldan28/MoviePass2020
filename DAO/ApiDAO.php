<?php namespace DAO;

    class ApiDAO{
        

        public function RetrieveDataMovie(){

            $fileMovie = file_get_contents(APINOWPLAYING);
<<<<<<< HEAD
=======
            $decodeMovie = json_decode($fileMovie,true);
            return $decodeMovie;
        }

        public function RetrieveDataMovie2($url){

            $fileMovie = file_get_contents($url);
>>>>>>> Rodrigo
            $decodeMovie = json_decode($fileMovie,true);
            return $decodeMovie;
        }
        

        public function RetrieveDataMovie2($idMovie){

            $fileMovie = file_get_contents(API.$idMovie.KEY);
            $decodeMovie = json_decode($fileMovie,true);
            return $decodeMovie;
        }


        public function RetrieveDataGender(){

            $fileGender = file_get_contents(GENDER);
            $decodeGender = json_decode($fileGender,true);
            return $decodeGender;
        }
   
    }
    

?>
