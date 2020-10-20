<?php
    namespace DAO;
    use Models\Gender as Gender;
    use DAO\Connection as Connection;

    interface IGenderDAO{

        function GetAll();
        function AddGender(Gender $gender);
        function checkIfExist($idGender);

    }
?>