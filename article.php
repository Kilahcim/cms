<?php
include_once 'init.php';
include_once 'navbar.php';
include_once 'header.php';


if($object -> is_logged()) {

  if (!empty($_POST['tytul']) && !empty($_POST['tresc']) && !empty($_SESSION['user_name'])) {
    $article->add_article($_POST['tytul'], $_POST['tresc'], $_SESSION['user_name']);
  }
?>
<?php
if(isset($_SESSION['modal_messages'])){

 ?>


    <div class="col-xs-12 col-md-6 col-md-offset-3 text-center">
      <div class="flex_modal">
        <div class="form_box">
          <?php
            print "<p class='text-center'>{$_SESSION['modal_messages']}</p>";
            $_SESSION['modal_messages'] = null;
          ?>
        </div>
      </div>
    </div>

<?php
}
?>

<div class="col-xs-12 col-md-6 col-md-offset-3">
  <div class="form_box article">
    <form class="edit" action="article.php" method="post">
      <fieldset>
       <p>Dodaj artykuł</p>
        <label for="tytul">
          <input type="text" name="tytul" placeholder="Tytul artykulu">
        </label>
        <label for="tresc">
          <textarea name="tresc" rows="8" cols="50"></textarea>
        </label>
        <div class="center">
          <button type="submit" name="change_name" value="Submit">Add article!</button>
        </div>
      </fieldset>
    </form>
  </div>
</div>
<?php
include_once 'footer.php';
}
?>
