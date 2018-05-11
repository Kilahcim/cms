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
