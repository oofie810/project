<?php
    class LogAction{
    
	public static function insertLog($user_id, $action){
	
	    $ip = $_SERVER['REMOTE_ADDR'];
	    $sql = 'INSERT INTO log (user_id, action, date, ip_addr) VALUES (:id, :action, NOW(), :ip)';
	    $params = array (':id'	=> $user_id,
			     ':action'	=> $action,
			     ':ip'	=> $ip);
	    Database::insert ($sql, $params);
	}
    }


?>

