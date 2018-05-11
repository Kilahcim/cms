<?php

include_once 'init.php';
if($object->is_logged()) {
include_once 'admin_navbar.php';
include_once 'header.php';
include_once 'user.php';

// debug($_SESSION['result']);

 // TO JEST NASZ WYBRANY INDEKS ARTYKUŁU W ZMIENNEJ POST WYSŁANEJ Z FORMULARZA SELEKT ART.
// debug($_SESSION['id_art']);

if ( $object->is_logged() ) {
?>
<div class="container ">
  <div class="row">
    <div class="col-xs-12- col-md-6 col-md-offset-3">
      <form class="edit_art" action="article_select.php" method="post">
        <div class="form_box">
        <?php
            print '<input type="hidden" name="id_art" value="'. $_SESSION["result"][0][0] . '"/>';
            print '<p>Tytuł:</p>';
            print '<input type="text" name="tytul" value="'. $_SESSION['result'][0][1] . '"/>';
            print '<p>Treść:</p>';
            print '<textarea name="tresc">' . $_SESSION['result'][0][2] . '</textarea>';
            print '<p>Autor:</p>';
            print '<input type="text" name="autor" value="' .$_SESSION['result'][0][3] . '"/>';
            print '<p>Data publikacji:</p>';
            print '<input type="text" name="data_publikacji" value="' .$_SESSION['result'][0][4] . '"/>';
            print '<p>Data aktualizacji:</p>';
            print '<input type="text" name="data_aktualizacji" value="' .$_SESSION['result'][0][5] . '"/>';

        ?>
          <button type="submit" name="edit_art" value="">Zmień</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
if (isset($_POST['edit_art'])) {
  $show->show_selected($_SESSION['result'][0][0]);
  $article->edit_article($_POST['tytul'], $_POST['tresc'], $_POST['autor'], $_POST['data_publikacji'], $_POST['data_aktualizacji'], $_POST['id_art']);
    }
  }
}
include_once('footer.php');
 ?>
