<?php

  session_start();
  require_once ('connectvars.php');


  function logaction($username, $action){
     $ip = $_SERVER['REMOTE_ADDR']; 
     $dbc=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('error in funtion'.mysqli_error($dbc)); 
     $query = "SELECT user_id FROM user where username ='$username'";
   
     $data = mysqli_query($dbc, $query) or die('error in function 13'.mysqli_error($dbc));
   
     $row = mysqli_fetch_array($data);

     $id = $row['user_id'];
 
     $query = "INSERT INTO log (user_id, action, date, ip_addr) VALUES ($id, $action, NOW(), '$ip')";

     mysqli_query ($dbc, $query) or die ('error function 21'.mysqli_error($dbc));

     mysqli_close($dbc); 
   }

  function new_user_signup($username, $pass, $code, $email){
     echo $username, $pass;   
     $dbc=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('error in funtion'.mysqli_error($dbc));     
 
     $query1 = "INSERT INTO user (username, password, email) VALUES ('$username','$pass', '$email')";

     mysqli_query($dbc, $query1) or die ('Error fn ln 29:'.mysqli_error($dbc));

     //insert into passkey table the hash code for confirmation
     $id = get_user_id_from_email($email);
   
     $query3 = "INSERT INTO passkey (passkey, user_id, date_created) VALUES ('$code', $id, NOW())";
     mysqli_query($dbc, $query3) or die ('Error fn ln 42: '.mysqli_error($dbc));
     
     logaction($username, 1);
    
     return true;
   } 
  
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
       $message .= "http://192.168.1.22/confirmation.php?passkey=$code";

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
