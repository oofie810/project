<?php
  $x = 'index';
  session_start(); 
  require_once('../lib/header.php');
  require_once('../lib/connectvars.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if(isset($_SESSION['username'])){
    echo '<p>You are logged in as ' .$_SESSION['username']. '</p>';
    echo '<p>You can submit recipes using this <a href="submit.php">link</a></p>';
//    echo '<p>You can view your profile <a href="viewprofile.php">here</a></p>';
    echo '<p>You can edit your profile <a href="editprofile.php">here</a></p>';
    echo '<p>You can edit your user settings <a href="usersettings.php">here</a></p>';
//    echo '<p>You can log out <a href="logout.php">here</a></p>';
    echo $_SERVER['REMOTE_ADDR'];
   }
  // else{
    // echo '<p class="error">You are not logged in.</p>';
    // echo 'You can log in <a href="login.php">here</a> or sign up <a href="signup.php">here</a>.';
      // }

    
    //display recipes submitted
    $query = "SELECT rec_id, rec_name, directions FROM recipe WHERE rec_name IS NOT NULL ORDER BY submission_date DESC";
    $data =mysqli_query($dbc, $query) or die ('error ln 29: '.mysqli_error($dbc));

    echo '<h4>Latest Recipes:</h4>';
    while ($row = mysqli_fetch_array($data)){
	if(isset($_SESSION['username'])){
	    echo '<h4><a href="viewrecipe.php?rec_id=' . $row['rec_id'] . '">'.$row['rec_name'].'</a></h4>';
	    echo '<p>' . substr($row['directions'], 0, 240) .'...</p><br />';
	    }
	  else{  
	    echo '<h4>' . $row['rec_name']. '</h4>' .
	    '<p>' . substr($row['directions'], 0, 240) . '...</p><br />'; 								}
       }

require_once('../lib/footer.php');
?>

