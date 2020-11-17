
<div style="position:fixed;">
    <?php 
require_once('head.php');
 require_once('nav-admin.php');
 require_once("validate-session.php");
?>
</div>
<br>
<div>

<form action="<?php echo FRONT_ROOT?>Cinema/ShowAddRoomView" method="post">
    <div class="TableStylesCinema">
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
                    <td class="tdImg" rowspan="2" ><img src=<?php echo FRONT_ROOT.VIEWS_PATH."img\pngwing.com.png"?> alt="asdasds" width="100" height="100"></td>
                    <td><?php echo $cinema->getAdress() ?></td>
                </tr>
                <tr>
                    <td><?php echo $cinema->getId() ?></td>
                </tr>
            </tbody>
        </table><?php 
                }
                ?>
    </div>
</form>
</div>
