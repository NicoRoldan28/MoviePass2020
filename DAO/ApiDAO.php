<?php namespace DAO;

    class ApiDAO{
        

        public function RetrieveDataMovie(){

            $fileMovie = file_get_contents(APINOWPLAYING);
            $decodeMovie = json_decode($fileMovie,true);
            return $decodeMovie;
        }

        public function RetrieveDataMovie2($url){

            $fileMovie = file_get_contents($url);
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
