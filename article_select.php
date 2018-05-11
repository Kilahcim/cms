<?php
include_once 'init.php';

if($object->is_logged()) {

include_once 'admin_navbar.php';
include_once 'header.php';
include_once 'user.php';



?>
<div class="container">
  <div class="row">
    <div  class='col-xs-12 col-md-6 col-md-offset-3 select_art'>
      <?php
      $show-> show_articles();
      print '<form action="article_select.php" method="post">';
      print '<table>';
      if($object->is_logged()) {
        foreach ($_SESSION['result'] as $key => $values) {
          print '<tr>';
          print "<td> <input type='checkbox' name='checked_id[]' value='{$values[0]}'/> </td>";
          print '<td> ' . $_SESSION['result'][$key][0] . '</td>';
          print '<td> ' . $_SESSION['result'][$key][1] . '</td>';
          $length = count($_SESSION['result']);

          print '</tr>';
        }
        print '</table>';
        print '<button type="submit" name="show_selected">Edytuj wybrany artykuły</button>';
        print '</form>';

      ?>
    </div>

  </div>
</div>
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
?>

<?php
if (isset($_POST['show_selected'])) {
  $show->show_selected($_POST['checked_id'][0]);
  header('Location: article_edit.php');
  exit();
  }
}
include_once 'footer.php';
} else {
  print 'Proszę się zalogować!';
}
 ?>
