<?php
include_once 'init.php';
include_once 'navbar.php';
include_once 'header.php';
include_once 'footer.php';
if($object->is_logged()) {
  if ($_SESSION['account_details'][0][4] == 1) {
    header('Location: admin_panel.php');
    exit();

  } else {

  }
  ?>
  <div class="container">
    <div class="row">
      <div  class='col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3'>
        <?php
        if($object->is_logged()) {
            $show->show_articles();
            $length = count($_SESSION['result']);
            print '<form>';
            print '<div class="slider">';

            for ($i=0; $i < $length; $i++) {

              print '<div class="slider_content ">';
              print '<h2 class="tytul">' . $_SESSION['result'][$i][1] . '</h2>';
              print '<p>' .'<span class="color">Treść: </span>' . $_SESSION['result'][$i][2] . '</p>';
              print '<p>' . '<span class="color">Autor:</span>' . ' ' . $_SESSION['result'][$i][3] . '</p>';
              print '<p>' . '<span class="color">Data publikacji:</span>' . ' ' . $_SESSION['result'][$i][4] . '</p>';
              print '<p>' . '<span class="color">Data aktualizacji:</span>' . ' ' . $_SESSION['result'][$i][5] . '</p>';
              print '</div>';

            }
            print '</div>';
            print '</form>';

        ?>
      </div>
  <!-- <?php
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
  ?> -->
    </div>
  </div>




<?php

}
?>
<script>
$('.slider').slick({
  dots: true,
  autoplay: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  adaptiveHeight: true
});
</script>
<?php
}
include_once 'footer.php';
 ?>
