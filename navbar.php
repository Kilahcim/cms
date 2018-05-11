<?php
include_once('init.php');
 ?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img src="images/logo.png" alt="logo" title="logo">
      </a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href='./home.php'>Strona główna</a></li>
        <li><a href="./profile.php">Edytuj profil</a></li>
        <li><a href="./article.php">Dodaj artykuł</a></li>
      </ul>

      <form action="index.php" method="post" class="nav navbar-nav navbar-right">
        <button type="submit" name="log-out" class="btn btn-default">Wyloguj się</button>
      </form>
    </div>
  </div>
</nav>
<?php
if(isset($_POST['log-out'])) {
   $object->log_out();
 }
?>
