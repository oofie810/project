<?php
  class SendEmail{

	  public static function send($email, $code){
	    $to = $email;
  
	    $subject = "Registration";
	    $message = "Your confirmation link. Click please \n\r ";
	    $message .= "http://bestfoodhub.com/confirmation.php?passkey=$code";

	    mail($to,$subject,$message);
       
	    return true;
	  }
  }

?>
