<?php
  function thumbnail( $image_name, $image_type, $in_sources) 
    {     
      global $IMAGE_PATH;
      global $THUMB_PATH;
      global $THUMB_WIDTH;
      if ($in_sources)
      {
        $PREFIX = "";
      } else
      {
        $PREFIX = "../";
      }
      
      $src_img = imagecreatefromjpeg($PREFIX.$IMAGE_PATH."/".$image_name);
      
      $origw=imagesx($src_img); 
      $origh=imagesy($src_img); 
      
      $diff=$origw/$origh; 
      if ($diff > 1.3333333)
      {
        $new_w = $THUMB_WIDTH; 
        $divisor = $origw / $new_w;
        $new_h = $origh / $divisor; 
      } else
      {
        $new_h = $THUMB_WIDTH*0.75;
        $divisor = $origh / $new_h;
        $new_w = $origw / $divisor; 
      }

      $dst_img = imagecreatetruecolor($new_w,floor($new_h)); 
      imageAntiAlias($dst_img, true);
      imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 
        
      imagejpeg($dst_img, $PREFIX.$THUMB_PATH."/"."thumb_".$image_name);
      
      return true; 
    }
?>