<?php function  make_thumbnail( $file_name, $thumb_width, $thumb_height, $max_size) {
    
$image_info = getimagesize( $file_name );
        
switch ( $image_info['mime'] ) {
            
 case 'image/gif':
  if (imagetypes() & IMG_GIF) {
   $image = imagecreatefromGIF($file_name);
  }else {
    
   $err_str = 'GD не поддерживает GIF';
  }
 break;

 case 'image/jpeg':
    
  if (imagetypes() & IMG_JPG) {
    
    $image = imagecreatefromJPEG($file_name);
  }else {
    
    $err_str = 'GD не поддерживает JPEG';
  }
  break;
  case 'image/png':
   if (imagetypes() & IMG_PNG) {
     $image = imagecreatefromPNG($file_name);
   }else {
     $err_str = 'GD не поддерживает PNG';
   }break;
   default:
     $err_str = 'GD не поддерживает ' . $image_info['mime'];
   }
   
   if (isset($err_str)) {
     print $err_str;
   }
                 
   $image_width = imagesx( $image );
   $image_height = imagesy( $image );
   
   //задано ограничение на высоту и ширину:
   
   if ($max_size) {
   
    if ($image_width < $image_height) {
                        
     $thumb_height = $max_size;
     $thumb_width =   round($max_size * $image_width / $image_height);
     
    }else {
     $thumb_width = $max_size;
     $thumb_height = round($max_size * $image_height / $image_width);
    }
    }     //задана только ширина
    elseif ($thumb_width && !$thumb_height) {
     $thumb_height = round($thumb_width * $image_height / $image_width);
    }//задана только высота
    elseif (!$thumb_width && $thumb_height) {
     $thumb_width =  round($thumb_height * $image_width / $image_height);
    }
     //не задан ни один из размеров
    else {
     $thumb_width = $image_width;
     $thumb_height = $image_height;
    }
    
     $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
     imagealphablending($thumb, false);
     imagesavealpha($thumb, true);
     
     imagecopyresampled($thumb, $image, 0, 0, 0, 0, $thumb_width, $thumb_height, $image_width, $image_height);
     imagePNG($thumb);
     //освобождаем память
     imagedestroy($image);
     imagedestroy($thumb); 
  }
  
  $width = isset($_GET['width']) ? (int) $_GET['width'] : 0;
  $height = isset($_GET['height']) ? (int) $_GET['height'] : 0;
  $max_size = isset($_GET['max_size']) ? (int) $_GET['max_size'] : 0;
  $file_name = $_GET['file']; 
  
  header('Content-Type: image/png');
  make_thumbnail($file_name, $width, $height, $max_size);
  define ('IMG_CACHE', $_SERVER['DOCUMENT_ROOT'].'/img_cashe/');
  //для корректной работы filemtime
  clearstatcache();
  //имя файла с кешем
  $cache_file_name = md5($file_name);
  $cache_mtime = 0;
  
  if (is_file(IMG_CACHE . $cache_file_name)) {
    
    $cache_mtime = filemtime(IMG_CACHE . $cache_file_name);
    
  }
  
  if ($cache_mtime < filemtime($file_name)) {
    //буферизация вывода
    ob_start();
    $result = make_thumbnail($file_name, $width, $height, $max_size);
    $thumbnail = ob_get_contents();
    $thumb_size = ob_get_length();
    ob_end_clean();
    if ($result)
    {
      echo 'Ошибка: ' . $result;         exit();
      }     //кеширование миниатюры
      $fd = fopen(IMG_CACHE . $cache_file_name, "wb");
      fwrite($fd, $thumbnail);
      fclose($fd);
      $cache_mtime = filemtime(IMG_CACHE . $cache_file_name);
      } else {
        //загрузка миниатюры из кеша
        $fd = fopen(IMG_CACHE . $cache_file_name, "rb");
        $thumb_size = filesize(IMG_CACHE . $cache_file_name);
        $thumbnail = fread ($fd, $thumb_size);
        fclose ($fd);
      }
      #header('Content-Type: image/png');
      //время создания миниатюры
      #header('Last-Modified: '.gmdate('D, d M Y H:i:s', $cache_mtime).' GMT');
      #header('Content-Length: '.$thumb_size); //вывод миниатюры в браузер
      echo $thumbnail; 
?>