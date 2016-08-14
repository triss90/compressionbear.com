<?php
//Compression function
function compress_image($source_url, $destination_url, $quality) {
  $info = getimagesize($source_url);

  if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
  elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
  elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);

  imagejpeg($image, $destination_url, $quality);

  return $destination_url;
}

// function compress_image($source_url, $max_quality = 90) {
//
//     if (!file_exists($source_url)) {
//         throw new Exception("File does not exist: $source_url");
//     }
//
//     $min_quality = 60;
//
//     $compressed_png_content = shell_exec("pngquant --quality=$min_quality-$max_quality - < ".escapeshellarg($source_url));
//
//     if (!$compressed_png_content) {
//         throw new Exception("Conversion to compressed PNG failed. Is pngquant 1.8+ installed on the server?");
//     }
//
//     return $compressed_png_content;
// }








// Format Bytes to KB
function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment one of the following alternatives
    $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
}


// Upload image
if(isset($_FILES['file'])) {
  $timestamp = time();
  $errors= array();
  $file_name = $timestamp.'_'.$_FILES['file']['name'];
  $file_name_compressed = $timestamp.'_comp_'.$_FILES['file']['name'];
  $file_size = $_FILES['file']['size'];
  $file_tmp = $_FILES['file']['tmp_name'];
  $file_type = $_FILES['file']['type'];
  $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));

  $expensions= array("jpeg","jpg","png");

  if(in_array($file_ext,$expensions) === false) {
    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
  }

  if($file_size > 5242880) {
    $errors[]='File size less than 5 MB';
  }

  if(empty($errors)==true) {

    move_uploaded_file($file_tmp,"uploads/".$file_name);

    // Define image path
    $source_photo_path = 'uploads/'.$file_name;
    $dest_photo_path = 'uploads/'.$file_name_compressed;

    // Compress image
    compress_image($source_photo_path, $dest_photo_path, 75);
    //compress_image($source_photo_path);

    // Get image sizes
    $source_photo_size = filesize($source_photo_path);

    $dest_photo_size = filesize($dest_photo_path);

    // Delete original file
    unlink($source_photo_path);

    // Calculate compression
    $compression_percent = 100-(($dest_photo_size/$source_photo_size)*100); // Calculate the compression in %
    $compression_percent = number_format((float)$compression_percent, 2, '.', ''); // Round % to 2 decimals

    $source_photo_size = formatBytes($source_photo_size);
    $dest_photo_size = formatBytes($dest_photo_size);

    //echo 'Original: <strong>'.$source_photo_size.'</strong> &#8594; Compressed: <strong>'.$dest_photo_size.'</strong> (Reduced: <strong>'.$compression_percent.'%</strong>)';

    echo '{
        "source_size": "'.$source_photo_size.'",
        "dest_size": "'.$dest_photo_size.'",
        "dest_path": "'.$dest_photo_path.'",
        "compression": "'.$compression_percent.'"
      }';

  } else {
    print_r($errors);
  }

}


/*
http://stackoverflow.com/questions/19696187/php-how-to-compress-images-without-losing-visible-quality-automatically
https://pngquant.org/php.html
http://askubuntu.com/questions/469171/pngquant-2-0-for-ubuntu-12-04-not-available

Set permissions to upload folder
chmod 777 -R /var/www/gridder.io/public_html/
chown root:root -R /var/www/gridder.io/public_html/
*/
