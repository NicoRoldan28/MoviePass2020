<?php 

    namespace DAO;
    use Models\Cinema as Cinema;
    use DAO\Connection as Connection;

    interface ICinemaDAO{

        function Add(Cinema $cinema);
        function GetAll();
        function GetCinema($idCinema);
        //function getByEmail($email);

    }

?>