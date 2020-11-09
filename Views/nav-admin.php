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
          <li><a href="<?php echo  FRONT_ROOT."Cinema/ShowListShowingView "?>">SHOWINGS LIST</a></li>
        </ul>
      </li>
  </ul>
</nav>


