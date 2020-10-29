<div class="wrapper row1">
  <header id="header" class="clear"> 
  <nav id="mainav" class="fl_right">
        <nav class="navegacion">
          <ul class="menu">
          <li><a href="#">CINEMA</a>
              <ul class="submenu">
              <li><a href="<?php echo  FRONT_ROOT."Cinema/ShowAddCinemaView "?>">CINEMA ADD</a></li>
              <li><a href="<?php echo  FRONT_ROOT."Cinema/ShowListCinemaView "?>">CINEMA LIST</a></li>
              </ul>
          </li>
            
            <li><a href="#">MOVIES</a>
              <ul class="submenu">
                <li><a href="<?php echo  FRONT_ROOT."Movie/SaveDataBD "?>">UPDATE MOVIES</a></li>
                <li><a href="<?php echo  FRONT_ROOT."Movie/ShowListView"?>">LIST MOVIES</a></li>
              </ul>
            </li>
            <li><a href="#">GENDERS</a>
              <ul class="submenu">
                <li><a href="<?php echo  FRONT_ROOT."Gender/SaveDataBD "?>">UPDATE GENDERS</a></li>
                <li><a href="<?php echo  FRONT_ROOT."Gender/ShowListView "?>">LIST GENDERS</a></li>
              </ul>
            </li>
            <li><a href="#">ROOMS</a>
              <ul class="submenu">
                <li><a href="<?php echo  FRONT_ROOT."Cinema/ShowAddRoomView "?>">ROOM ADD</a></li>
                <li><a href="<?php echo  FRONT_ROOT."Cinema/ShowListRoomView "?>">ROOM LIST</a></li>
              </ul>
            </li>
            <li><a href="#">SHOWINGS</a>
              <ul class="submenu">
                <li><a href="<?php echo  FRONT_ROOT."Cinema/selectCinema "?>">SHOWING ADD</a></li>
                <li><a href="<?php echo  FRONT_ROOT."Cinema/ShowListRoomView "?>">SHOWINGS LIST</a></li>
              </ul>
            </li>
  
            <li><a style="background-color: #3e94ec"  href="<?php echo  FRONT_ROOT."Home/Logout "?>">LOGOUT</a></li>
          </ul>
        </nav>
    </nav>
  </header>
</div>

<style>


/*body{
	background: #313D52;
}

header{
	width: 100%;
}*/
/*
.navegacion{
	width: 1000px;
	margin: 30px auto;
	background: #fff;
}*/



.navegacion ul{
	list-style: none;
}

.menu > li{
	position: relative;
	display: inline-block;
}

.menu > li > a{
  font-family: Arial;
  font-size: 11px;
	display: block;
	padding: 15px 20px;
	background-color: #324232;
  color: #fff;
	font-family: 'Open sans';
	text-decoration: none;
}


.menu li a:hover{
	color: #CE7D35;
	transition: all .3s;
}

/* Submenu*/

.submenu{
	position: absolute;
	background: #324232;
	width: 100%;
	visibility: hidden;
	opacity: 0;
	transition: opacity 1.5s;
}

.submenu li a{
	display: block;
	padding: 5px;
	color: #fff;
	font-family: 'Open sans';
	text-decoration: none;
}

.menu li:hover .submenu{
	visibility: visible;
	opacity: 1;
}



 .nav li a {
 font-family: Arial;
 font-size: 11px;
 text-decoration: none;
 float: left;
 padding: 10px;
 background-color: #324232;
 color: #fff;
 }

 .menu li {
 display: inline;
 }
 .menu {
 padding: 0;
 
 }
 .menu > li{
   float:left;
 }
 .menu li ul{
   position:absolute;
   min-width:140px;
 }
 .nav li:hover > ul{
   display:block;
 }

</style>