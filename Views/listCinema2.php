<?php 
require_once('head.php');
 require_once('nav-admin.php');
 require_once("validate-session.php");
?>
<div>
    <br>
    <h1 style='color:white;'>LIST OF CINEMAS</h1>
</div>
<br>
<form action="<?php echo FRONT_ROOT?>Cinema/ShowAddRoomView" method="post">
    <div class="TableStyles">
        <?php foreach($cineList as $cinema)
                {?>
        <table>
            <thead>
                <tr>
                    <th colspan="2"><?php echo $cinema->getName() ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2" ><img src="img\Background-Narrow.jpg"  srcset=""></td>
                    <td><?php echo $cinema->getAdress() ?></td>
                </tr>
                <tr>
                    <td><?php echo $cinema->getPrice_ticket() ?></td>
                </tr>
            </tbody>
        </table><?php 
                }
                ?>
    </div>
</form>