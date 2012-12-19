<?php
  $css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/Database.php');
  require_once('../lib/User.php');
  require_once('../lib/Image.php');
  require_once('../lib/appvars.php');

  if(!empty($_POST['submit'])){
    $selected = $_POST['imageSelect'];
    Image::resetShowcaseImage();
    foreach($selected as $key => $value){
      Image::updateShowcaseImage($key);
    }
  }
  
  
  if(User::isLoggedIn()){

    $user = User::loadUserFromUsername($_SESSION['username']);
    
    $access = $user->getPrivileges();
    if($access == 1){
      $data = Image::imageSelect();
      echo '<form method="post" action="admin.php">';
      foreach($data as $image){
        if($image->getHomepage() == 1){
          echo '<input type="checkbox" name="imageSelect['. $image->getId() . ']" value="1" checked="checked">';
        } else{
          echo '<input type="checkbox" name="imageSelect['. $image->getId() . ']" value="1">';
        }
        echo '<img src= "' . DISP . $image->getFilename() . '" /><br />';
      }
    } else{
      echo "You do not have access to this page";  
    }
?>

  <input type="reset" name="reset" />
  <input type="submit" value="Submit" name="submit" />
  </form>

<?php
  }else{
    echo "You do not have access to this page";  
  }
  require_once('footer.php');
?>
