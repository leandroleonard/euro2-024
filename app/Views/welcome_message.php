<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="pic/ball.png">
    <link rel="stylesheet" type="text/css" href="<?= base_url('home/homestyle.css') ?>">
  </head>
<body>
  <header>
    <div class="navtab">
      <img src="<?= base_url('home/pics/euro-2024-germany-official-logo-with-name-blue-symbol-european-football-final-design-illustration-free-vector.png') ?>" class="logo" />
      
      <nav>
        <ul>
          <li><a href="index.php">INÍCIO</a></li>
          <li><a href="teams.php">Seleções</a></li>
          <li><a href="matches.php">Jogos</a></li>
          <li><a href="player.php">Jogadores</a></li>
          <li><a href="stats.php">Estátisitcas</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <div class="homeback">
    <div class="wrapper">
      <form action="" method="post">
        <span><input type="text" placeholder=" O que está procurando?" name="search"></span>
        <button type="submit" name="submit" class="searchbtn"><img src="<?= base_url('home/pics/searchicon.png') ?>" class='icon' width= 50% height=50%></button>
      </form>
      </div>
    
    </div>
  </div>
</body>
</html>