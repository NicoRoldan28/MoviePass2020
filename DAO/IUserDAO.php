<?php 

    namespace DAO;
    use Models\User as User;
    use Models\PerfilUser as PerfilUser;
    use DAO\Connection as Connection;

    interface IUserDAO{

        function Add(User $user);
        //function GetAll();
        //function getByEmail($email);

    }

?>