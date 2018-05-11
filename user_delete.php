<?php
include_once 'init.php';
if ($object->is_logged()) {


include_once 'admin_navbar.php';
include_once 'header.php';

?>

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-6">
      <form class="user_delete" action="user_delete.php" method="post">
        <table>
        <?php
        $show->show_user();

        foreach ($_SESSION['user_list'] as $key => $values) {
          print '<tr>';
          print "<td> <input type='checkbox' name='checked_id[]' value='{$values['user_id']}'/> </td>";
          foreach ($values as $key => $value) {
            print '<td><input type="text" name="' . $values['user_id'] . '[' . $key . ']' . '"' . 'value="'. $value . '"></td>';
          }
          print "</tr>";
        }
        ?>
        </table>
        <div>
          <label>
            <button type="submit" name="delete_user">DELETE</button>
          </label>
          <label>
            <button type="submit" name="edit_user">EDIT</button>
          </label>
        </div>
      </form>
    </div>
  </div>
</div>

<?php


if (isset($_POST['delete_user']) && isset($_POST['checked_id'])) {
  foreach ($_POST['checked_id'] as $key => $value) {
    print $value;
    $object->delete_user($value);
  }
  header('Location: user_delete.php');
  exit();

} else if(empty($_POST['checked'])) {
  $_SESSION['modal_messages'] = "Upewnij się że wybrałeś użytkownika do edycji";
  }

if (isset($_POST['edit_user']) && isset($_POST['checked_id'])) {
  $id = $_POST['checked_id'][0];

  $object->edit_user($_POST[$id]['name'], $_POST[$id]['mail'], $_POST[$id]['privileges'], $_POST[$id]['user_id']);
  echo "<meta http-equiv='refresh' content='0'>";


} else if(empty($_POST['checked'])) {
  $_SESSION['modal_messages'] = "Upewnij się że wybrałeś użytkownika do edycji";
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
}
include_once 'footer.php';
?>

<!-- <script type="text/javascript">

  var inputs = document.querySelectorAll('input');


  for (var i = 0; i < inputs.length; i++) {

    inputs[i].setAttribute("readonly", true);
    console.log(inputs);
    Array.prototype.slice.call(inputs[i].attributes).forEach(function(item) {
       console.log(item.name + ': '+ item.value);
       if (inputs[i].hasAttribute(name) == ) {

       }
    });
  }


</script> -->
