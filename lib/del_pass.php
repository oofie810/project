<?php
    require_once('Database.php');
    #!/usr/bin/php
    
    $sql = "DELETE FROM passkey WHERE date_created < (NOW() - INTERVAL 24 HOUR)";
    $params = array();
    Database::update($sql, $params);

?>
