<?php
  //$css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/Database.php');
  require_once('../lib/User.php');
  require_once('../lib/Image.php');
  require_once('../lib/appvars.php');
  
  if(User::isLoggedIn()){

    $user = User::loadUserFromUsername($_SESSION['username']);
    
    $access = $user->getPrivileges();
    if($access == 1){
      $data = Image::imageSelect();
      echo '<form method="post" action="admin.php">';
        //set memcached
        echo "Caching turn off? -->";
        if($_COOKIE['cache'] == "set"){
          echo '<input type="checkbox" name="setCache" value="1" checked="checked"><br />';
        } else{
          echo '<input type="checkbox" name="setCache" value="1"><br />';  
        }
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


  if(!empty($_POST['submit'])){
    $cache = $_POST['setCache'];
    $selected = $_POST['imageSelect'];
    Image::resetShowcaseImage();
    foreach($selected as $key => $value){
    //set memcached
    echo "MEMCACHED";
    echo '<input type="checkbox" name="setCache" value="1">';
      Image::updateShowcaseImage($key);
    }
  }
  
  if($cache == 1){
    $time_to_dead = time() + 60 * 10;
    setcookie("cache", "set", $time_to_dead);
    echo "Caching is turned off for 1 hour.";  
  } else{
    setcookie("cache", "set", time() - 10);  
  }
  
  require_once('footer.php');
  
?>
