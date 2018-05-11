
<?php
include_once 'init.php';


print '<div class="container-fluid">';
if($object->is_logged()) {
  include_once 'navbar.php';
  include_once 'header.php';
  if ( isset($_POST['change_name']) && isset($_POST['email']) && isset($_POST['new_name']) && isset($_POST['password']) ) {
    $object-> name_edit($_POST['email'], $_POST['new_name'], $_POST['password']);
    // unset($_POST);
  }
  if ( isset($_POST['change_mail']) && isset($_POST['user']) && isset($_POST['email']) && isset($_POST['new_email']) && isset($_POST['password']) ) {

    $object-> email_edit($_POST['user'], $_POST['email'], $_POST['new_email'], $_POST['password']);
  }
  if ( isset($_POST['change_pass']) && isset($_POST['user']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['pass1']) && isset($_POST['pass2']) ){
    $object-> password_edit($_POST['user'], $_POST['email'], $_POST['password'], $_POST['pass1'], $_POST['pass2']);
  }

  if ( isset($_POST['delete_account']) && isset($_POST['user']) && isset($_POST['email']) && isset($_POST['password']) ) {
    $object -> delete_account($_POST['user'], $_POST['email'], $_POST['password']);
  }


?>
  <div class="row">
    <div class="choice">
      <div class="col-xs-12 col-md-3">
        <button type="button" class="edit"  name="edit_user">Edit your name</button>
        <div class="form_box unvisible">
          <form class="edit" action="profile.php" method="post">
            <fieldset>
             <p>Zmiana nazwy użytkownika</p>
              <label for="email">
                <input type="text" name="email" placeholder="Your email">
              </label>
              <label for="new_name">
                <input type="text" name="new_name" placeholder="New name">
              </label>
              <label for="password">
                <input type="password" placeholder="Password" name="password">
              </label>
              <button type="submit" name="change_name" value="Submit">Change name!</button>
            </fieldset>
          </form>
        </div>
      </div>
      <div class="col-xs-12 col-md-3">
        <button type="button"  class="edit" name="edit_mail">Edit your mail</button>
        <div class="form_box unvisible">
          <form class="edit" action="profile.php" method="post">
            <fieldset>
             <p>Zmiana maila</p>
              <label for="user">
                <input type="text" name="user" placeholder="User name">
              </label>
              <label for="email">
                <input type="text" name="email" placeholder="Your email">
              </label>
              <label for="email">
                <input type="text" name="new_email" placeholder="Your new email">
              </label>
              <label for="password">
                <input type="password" placeholder="Password" name="password">
              </label>
              <button type="submit" name="change_mail" value="Submit">Change email!</button>
            </fieldset>
          </form>
        </div>
      </div>
      <div class="col-xs-12 col-md-3">
        <button type="button"  class="edit" name="edit_pass">Edit your password</button>
        <div class="form_box unvisible">
          <form class="edit" action="profile.php" method="post">
            <fieldset>
             <p>Zmiana hasła</p>
              <label for="user">
                <input type="text" name="user" placeholder="User name">
              </label>
              <label for="email">
                <input type="text" name="email" placeholder="Your email">
              </label>
              <label for="password">
                <input type="password" placeholder="Password" name="password"
              </label>
              <label for="password1">
                <input type="password" placeholder="New password" name="pass1"
              </label>
              <label for="password2">
                <input type="password" placeholder="Repeat new password" name="pass2"
              </label>
              <button type="submit" name="change_pass" value="Submit">Change password!</button>
            </fieldset>
          </form>
        </div>
      </div>
      <div class="col-xs-12 col-md-3">
        <button type="button"  class="edit" name="edit_pass">Delete your account</button>
        <div class="form_box unvisible">
          <form class="edit" action="profile.php" method="post">
            <fieldset>
             <p>Usuń konto</p>
              <label for="user">
                <input type="text" name="user" placeholder="User name">
              </label>
              <label for="email">
                <input type="text" name="email" placeholder="Your email">
              </label>
              <label for="password">
                <input type="password" placeholder="Password" name="password">
              </label>
              <button type="submit" name="delete_account" value="Submit">Delete user</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
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

</div>



<?php
}
include_once 'footer.php';
?>
<script>

</script>
