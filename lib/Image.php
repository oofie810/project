<?php
  require_once('../config/Config.php');
  require_once('../../../AWSSDKforPHP/sdk.class.php');

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
      $i = 0;
      foreach($_FILES['picture']['name'] as $n => $name){
        if(!empty($name)){
          $date = new DateTime();
          $extension = substr($name, -4);
          $filename = md5($date->format('U') . $submitted_by . $caption[$i] . $name) . $extension;
          $target = Config::getTmpFolder() . $filename;
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
            $img = self::resizeImage($filename, $extension, 1, 150, 100, 1);
            $img2 =self::resizeImage($filename, $extension, 1, 800, 600, 2);
            $files = array($img, $img2, $filename);
            self::bulkUploadS3($files);
            self::saveToImageToRecipeTable($id, $recipeId);
            unlink($img);
            unlink($img2);
            unlink($target);
          }
        }
        $i++;
      }
    }
   
    private static function bulkUploadS3($images){
      $s3 = new AmazonS3();
      foreach($images as $file){
        $s3->batch()->create_object(Config::getBucket(), $file, array(
            'fileUpload'  => Config::getTmpFolder() . $file,
            'acl'         => AmazonS3::ACL_PUBLIC
            //TODO have to add filetype here
            ));
      }
      $s3->batch()->send();
    
    }
    //editing to use with aws s3
    public static function saveUserImageS3($image, $submitted_by){
          $target = Config::getTmpFolder() . $image;
          move_uploaded_file($_FILES['picture']['tmp_name'], $target);
          $newImg = Config::getTmpFolder() . 'thumb_' . $image;
          copy(Config::getTmpFolder() . $image, $newImg);
          $imagick = new Imagick($newImg);
          $imagick-> thumbnailImage(300, 200);
          $imagick->writeImage();
          
          $filename = $_FILES['picture']['name'];
          $tempname = $_FILES['picture']['tmp_name'];
          error_log($tempname);
          error_log($filename);
          
          list($folder, $newFile) = explode('/', $newImg);
          
          $s3 = new AmazonS3();
          $s3->create_object(Config::getBucket(), $newFile, array(
                'fileUpload' => $newImg,
                'acl'        => AmazonS3::ACL_PUBLIC,
                'contentType'=> $_FILES['picture']['type']
               ));
          $s3->create_object(Config::getBucket(), $filename, array(
                'fileUpload' => $target,
                'acl'        => AmazonS3::ACL_PUBLIC,
                'contentType'=> $_FILES['picture']['type']
               ));
          unlink($newImg);
          unlink($target);
    }

    public static function saveUserImage($image, $submitted_by){
          $target = Config::getImageFolder() . 'user_images/' . $image;
          move_uploaded_file($_FILES['picture']['tmp_name'], $target);
            $newImage = Config::getImageFolder() . 'user_images/resized/' . $image;
            copy(Config::getImageFolder() . 'user_images/' . $image, $newImage);
            $imagick = new Imagick($newImage);
            $imagick->thumbnailImage(300, 200);
            $imagick->writeImage();
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
        error_log("inside resize");
        $newFilename = $height . 'x' . $width . '_' . $filename;
        $newImage = Config::getTmpFolder() . $newFilename;
        copy(Config::getTmpFolder() .  $filename, $newImage);
        $imagick = new Imagick($newImage);
        $imagick->thumbnailImage($height, $width);
        $imagick->writeImage();
        
        /*$sql = "INSERT INTO 
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
       */
        return $newFilename; 
    }
  }

?>
