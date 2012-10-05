<?php
  class LogAction{
	  public static function insertLog($userId, $action){
	    $ip = $_SERVER['REMOTE_ADDR'];
	    $sql = 'INSERT INTO action_log (user_id, action_id, date, ip_address) VALUES (:id, :action, NOW(), :ip)';
	    $params = array (':id'	=> $userId,
			                 ':action'	=> $action,
			                 ':ip'	=> $ip);
	    Database::insert ($sql, $params);
	  }
  
  }
?>

