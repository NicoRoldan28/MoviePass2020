<?php 

    namespace DAO;
    use Models\Cinema as Cinema;
    use DAO\Connection as Connection;

    interface ICinemaDAO{

        function Add(Cinema $cinema);
        function GetAll();
        function getCinemaById($idCinema);
        //function getByEmail($email);

    }

?>