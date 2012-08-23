<?php
  #!/usr/bin/php
   require_once('connectvars.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  $query = "DELETE FROM passkey WHERE date_created < (NOW() - INTERVAL 24 HOUR)";
  
  mysqli_query($dbc, $query);

  mysqli_close($dbc);

?>
