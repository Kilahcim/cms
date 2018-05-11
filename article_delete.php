<?php
include_once 'init.php';

if($object->is_logged()) {
  include_once 'admin_navbar.php';
  include_once 'header.php';
  include_once 'user.php';


if (isset($_POST['delete_art'])) {
  foreach ($_POST['checked_id'] as $key => $value) {
    $article->delete_article($value);
  }

}

?>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-md-6">
      <form class="article_delete" action="article_delete.php" method="post">
        <table>
          <?php
          $show->show_articles();
          foreach ($_SESSION['result'] as $key => $values) {
            print '<tr>';
            print "<td> <input type='checkbox' name='checked_id[]' value='{$values[0]}'/> </td>";
            foreach ($values as $key => $value) {
              print '<td><input type="text" name="' .$values[0] . '[' . $key . ']' . '"' . 'value="' . $value . '"></td>';
            }

          }
          ?>
        </table>
        <label>
          <button type="submit" name="delete_art">DELETE</button>
        </label>
      </form>
    </div>
  </div>
</div>
<?php
} else {
  $_SESSION['modal_messages'] = 'Proszę się zalogować!';

}
?>
<?php
if(isset($_SESSION['modal_messages'])){

 ?>

  <div class="row">
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
  </div>
<?php
}

include_once('footer.php');
?>
