<footer>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <?php
         // var_dump($_SESSION['account_details']);
          if (isset($_SESSION['user_name'])) {
            print 'Jestes zalogowany jako:' . ' ' . $_SESSION['user_name'];

          }
        ?>
      </div>
    </div>
  </div>
</footer>
<script src="app.js"></script>

</body>
</html>
<?php
$connection = null;
?>
