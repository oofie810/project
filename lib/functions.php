<?php

  require_once ('connectvars.php');
  require_once ('Database.php');
  require_once ('User.php');
  require_once ('LogAction.php');

/*  function logaction($username, $action){
    $ip = $_SERVER['REMOTE_ADDR'];
    $user = User::load($username);
    $id = $user -> getUserId();
    LogAction::insertLog($id, $action, $ip); 
  }
*/
  function get_user_id_from_email($email){
      $dbc=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('error in funtion'.mysqli_error($dbc));     
 
      $query = "SELECT user_id FROM user WHERE email = '$email'";

      $data = mysqli_query($dbc, $query) or die ('Error fn 53: '.mysqli_error($dbc));

      $row = mysqli_fetch_array($data);

      $user_id = $row['user_id'];
      return $user_id;

    } 

  function send_email($email, $code){
       echo 'in send_email function';

       $to = $email;
  
       $subject = "Registration";
       $message = "Your confirmation link. Click please \n\r ";
       $message .= "http://54.245.125.72/confirmation.php?passkey=$code";

       mail($to,$subject,$message);
       
       return true;
     }


  function get_user_id_from_username($username){
      $dbc=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('error in funtion'.mysqli_error($dbc));     

      $query = "SELECT user_id FROM user WHERE username = '$username'";

      $data = mysqli_query($dbc, $query) or die ('Error fn 53: '.mysqli_error($dbc));

      $row = mysqli_fetch_array($data);

      $user_id = $row['user_id'];
      return $user_id;

    }
?>
