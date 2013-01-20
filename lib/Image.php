<?php
  require_once('../config/Config.php');
  class Image{
    private $id, $filename, $submitted_by, $submission_date, $caption, $homepage;

    public function __construct($id, $filename, $submitted_by, $submission_date, $caption, $homepage){
      $this->id = $id;
      $this->filename = $filename;
      $this->submitted_by = $submitted_by;
      $this->submission_date = $submission_date;
      $this->caption = $caption;
      $this->homepage = $homepage;
    }

    public function getId(){
      return $this->id;  
    }
    public function setName($filename){
      $this->filename = $filename;  
    }
    public function getFilename(){
      return $this->filename;  
    }
    public function setSubmittedBy($submitted_by){
      $this->submitted_by = $submitted_by;  
    }
    public function getSubmittedBy(){
      return $this->submitted_by;  
    }
    public function setSubmissionDate($submission_date){
      $this->submission_date = $submission_date;  
    }
    public function getSubmissionDate(){
      return $this->submission_date;  
    }
    public function setCaption($caption){
      $this->caption = $caption;  
    }
    public function getCaption(){
      return $this->caption;  
    }
    public function setHomepage($homepage){
      $this->homepage = $homepage;  
    }
    public function getHomepage(){
      return $this->homepage;  
    }

    
    public static function saveImageWithCaption($image, $submitted_by, $caption, $recipeId){
      $config = Config::getInstance();
      $i = 0;
      foreach($_FILES['picture']['name'] as $n => $name){
        if(!empty($name)){
          $date = new DateTime();
          $extension = substr($name, -4);
          $filename = md5($date->format('U') . $submitted_by . $caption[$i] . $name) . $extension;
          $target = $config->path . $filename;
          if(move_uploaded_file($_FILES['picture']['tmp_name'][$n], $target)){
            $sql = "INSERT INTO 
                      image 
                      (filename, submitted_by, submission_date, caption) 
                    VALUES 
                      (:image, :submitted_by, NOW(), :caption)"; 
            $params = array(':image'        => $filename,
                            ':submitted_by' => $submitted_by,
                            ':caption'      => $caption[$i]);

            $id = Database::insert($sql, $params);
            
            //have to put it here because displayable_image table needs original image id
            //resizeImage needs (filename, ext, id, H, W, resolution)
            self::resizeImage($filename, $extension, $id, 150, 100, 1);
            self::resizeImage($filename, $extension, $id, 800, 600, 2);
            self::saveToImageToRecipeTable($id, $recipeId);
          }
        }
        $i++;
      }
    }

    public static function saveToImageToRecipeTable($imageId, $recipeId){
      $sql = "INSERT INTO image_to_recipe (image_id, recipe_id) VALUES (:imageId, :recipeId)";
      $params = array(':imageId'  => $imageId,
                      ':recipeId' => $recipeId);
      Database::insert($sql, $params);
    }

    //load functions load images from image table. have to copy and modify to load from displayable
    //images table
    public static function loadImagesByRecipeId($recipeId){
      $sql = "SELECT * FROM image i JOIN image_to_recipe itr ON itr.image_id = i.id WHERE itr.recipe_id = :recipeId";

      $params = array (':recipeId' => $recipeId);
      $data = Database::getMultipleRows($sql, $params);
      $images_array = array();
      foreach ($data as $image){
        $images_array[] = new Image($image['id'], $image['filename'], $image['submitted_by'], $image['submission_date'], $image['caption'], $image['homepage']);  
      }
      return $images_array;
    }

    public static function loadImageForSearchRecipe($recipeId, $resolution){
      $sql = "SELECT * FROM displayable_images di JOIN image_to_recipe itr ON itr.image_id = di.id WHERE itr.recipe_id = :recipeId AND di.resolution = :res";
      $params = array (':recipeId'  => $recipeId,
                       ':res'  => $resolution);
      $data = Database::getMultipleRows($sql, $params);
      $images_array = array();
      foreach ($data as $image){
        $images_array[] = new Image($image['id'], $image['filename'], $image['submitted_by'], $image['submission_date'], $image['caption'], $image['homepage']);  
      }
      //TODO figure out how to return random image instead of first image
      return $images_array[0];
    }
  
    public static function imageSelect(){
      $sql = "SELECT * FROM image";
      $params = array();
      $data = Database::getMultipleRows($sql, $params);
      
      $images_array = array();
      foreach ($data as $image){
        $images_array[] = new Image($image['id'], $image['filename'], $image['submitted_by'], $image['submission_date'], $image['caption'], $image['homepage']);  
      }
      return $images_array; 
    }

    public static function updateShowcaseImage($id){
      $sql = "UPDATE image SET homepage = 1 WHERE id = :id";
      $params = array (':id'  => $id);
      $data = Database::update($sql, $params);
      
      return true;
    }

    public static function resetShowcaseImage(){
      $sql = "UPDATE image SET homepage = 0";
      $params = array ();
      $data = Database::update($sql, $params);
      
      return true;
      
    }

    public static function loadImagesByUser($userId){
      $sql = "SELECT * FROM image WHERE submitted_by = :user";
      $params = array(':user' => $userId);
      $data = Database::getMultipleRows($sql, $params);
      
      $images_array = array();
      foreach ($data as $image){
        $images_array[] = new Image($image['id'], $image['filename'], $image['submitted_by'], $image['submission_date'], $image['caption'], $image['homepage']);  
      }
      error_log(print_r($images_array, true));
      return $images_array;
    }

    public static function updateImageCaption(){
        
    }

    public static function resizeImage($filename, $extension, $id, $height, $width, $resolution){
        $config = Config::getInstance();
        $newImage = $config->imageFolder . $height . 'x' . $width . '/' . $filename;
        copy($config->path . $filename, $newImage);
        $imagick = new Imagick($newImage);
        $imagick->thumbnailImage($height, $width);
        $imagick->writeImage();
        
        $sql = "INSERT INTO 
                  displayable_images 
                  (image_id, filename, resolution, type)
                VALUES
                  (:id, :filename, :resolution, :type)";
        //resolution is 1 for now. have no idea what to designate to those
        $params = array(':id'   => $id,
                        ':filename' => $filename,
                        ':resolution' => $resolution,
                        ':type' => $extension);
        Database::insert($sql, $params);
        
    }
  }

?>
