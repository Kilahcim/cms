<?php
include_once 'init.php';
include_once 'header.php';

var_dump(isset($_POST['log-out']));
if(isset($_POST['log-out'])) {
   $object->log_out();
   // session_unset();
 }
if (isset($_POST['log_in']) && isset($_POST['user']) && isset($_POST['password']) ) {
  $object -> log_in($_POST['user'], $_POST['password']);

 }
if(isset($_POST['submit'])) {
  $name = $_POST['user'];
  $pass = $_POST['pass'];

  $object->log_in($name, $pass);
}

if( isset($_POST['sign_in']) && isset($_POST['user']) && isset($_POST['email']) && isset($_POST['pass1']) && isset($_POST['pass2'])) {
  $object->Register($_POST['user'], $_POST['email'], $_POST['pass1'], $_POST['pass2'], $_POST['privilages']);
}

?>

    <div class="container user_panel">
      <div class="row">
        <div class="col-md-5">
          <h2>Please log in to continue</h2>
          <?php
          if(isset($_SESSION['modal_messages'])){

           ?>
            <div class="flex_modal">
              <div class="form_box">
                <?php
                  print "<p>{$_SESSION['modal_messages']}</p>";
                  $_SESSION['modal_messages'] = null;
                ?>
              </div>
            </div>
          <?php
          }
          ?>

        </div>
        <div class="col-md-7">
          <div class="form_box">

            <form class="login_form" action="index.php" method="post">
              <fieldset>
                <p>Existing User</p>
                <label for="user">
                  <input type="text" id="user" name="user" placeholder="Type your user name" value="">
                </label>
                <label for="password">
                  <input type="password" name="pass" id="password" placeholder="Type your password">
                </label>
                <button type="submit" name="submit" value="Submit">Log in !</button>
              </fieldset>
              <p class="text-center">Forgot your details?</p>


            </form>
          </div>
          <div class="form_box">
            <form class="registry_form" action="index.php" method="post">
              <fieldset>
               <p>New User ?</p>
                <label for="user">
                  <input type="text" id="user" name="user" placeholder="User name" value="<?php if(isset($_POST['user']) && isset($_POST['sign_in'])){echo $_POST['user'];}?>">
                  <p>Nazwa użytkownika musi rozpoczynać się od dużej litery i mieć max 16 znaków</p>
                </label>
                <label for="email">
                  <input type="text" name="email" id="email" placeholder="Your email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>">
                </label>
                <label for="password1">
                  <input type="password" placeholder="Password" name="pass1" id="password1">
                  <p>Hasło musi składać się z min 8 max 20 znaków i zawierać duże i małe literki, min 1 cyfre i min 1 znak specjlany.</p>
                </label>
                <label for="password2">
                  <input type="password" placeholder="Repeat password" name="pass2" id="password2">
                </label>
                  <input type="hidden" name="privilages" value="NULL">
                <button type="submit" name="sign_in" value="Submit">Sign In!</button>

              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
