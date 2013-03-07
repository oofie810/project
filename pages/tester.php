<?php
  $css_files = array('index.css');
  require_once('header.php');
  require_once('../lib/appvars.php');
  require_once('../lib/Database.php');
  require_once('../lib/Recipe.php');
  require_once('../lib/Ingredient.php');
  require_once('../lib/Image.php');

?>
    <div id="galleria">
  <?php
    $picArray = Image::loadImagesByRecipeId(19);
    foreach($picArray as $pic){
      //echo '<img src="/thumbs/img10.jpg" />';
      echo '<img src="' . UP_PATH . $pic->getFilename() . '" />';
      }
    ?>
    </div>
<style>
  #galleria{ width: 700px; height: 400px; background: #000 }
</style>
<!--
      <div id="galleria">
      <img src="/thumbs/img10.jpg" />;
      <img src="/thumbs/img11.jpg" />;
      <img src="/thumbs/img12.jpg" />;
      <img src="/thumbs/img13.jpg" />;
      <img src="/thumbs/img14.jpg" />;
      <img src="/thumbs/img15.jpg" />;
      </div>
      --!>
  <script>
    Galleria.loadTheme('scripts/galleria/themes/classic/galleria.classic.min.js');
    Galleria.run('#galleria');
  </script>

<?php
  require_once('footer.php');
?>

