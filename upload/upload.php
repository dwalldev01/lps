<?php
global $General;
$load = '../../../../wp-config.php';
if (file_exists($load)){  //if it's >WP-2.6
  require_once($load);
  }
  else {
 wp_die('Error: Config file not found');
 }
 
  global $upload_folder_path;       
 $today = getdate();
if ($today['month'] == "January"){
  $today['month'] = "01";
}
elseif ($today['month'] == "February"){
  $today['month'] = "02";
}
elseif  ($today['month'] == "March"){
  $today['month'] = "03";
}
elseif  ($today['month'] == "April"){
  $today['month'] = "04";
}
elseif  ($today['month'] == "May"){
  $today['month'] = "05";
}
elseif  ($today['month'] == "June"){
  $today['month'] = "06";
}
elseif  ($today['month'] == "July"){
  $today['month'] = "07";
}
elseif  ($today['month'] == "August"){
  $today['month'] = "08";
}
elseif  ($today['month'] == "September"){
  $today['month'] = "09";
}
elseif  ($today['month'] == "October"){
  $today['month'] = "10";
}
elseif  ($today['month'] == "November"){
  $today['month'] = "11";
}
elseif  ($today['month'] == "December"){
  $today['month'] = "12";
}

   // Edit upload location here
  	//$imagepathupload = $General->get_product_imagepathupload();
	if($imagepathupload == '')
	{
		$imagepathupload = 'data_images';
	}
	$upload_folder_path="wp-content/uploads/";
	if($_GET['apk']=="apk")
		$imagepathupload = 'app_apk';
	
	//$destination_path = ABSPATH . "wp-content/uploads/".$today['year']."/".$today['month']."/";
 	 $destination_path = ABSPATH . $upload_folder_path.$imagepathupload."/";
   if (!file_exists($destination_path)){
      $imagepathuploadarr = explode('/',$upload_folder_path.$imagepathupload);
	   $upload_path = ABSPATH . "$imagepathupload";
	  if (!file_exists($upload_path)){
		mkdir($upload_path, 0777);
	  }
	  $year_path = ABSPATH;
	  for($i=0;$i<count($imagepathuploadarr);$i++)
	  {
		  if($imagepathuploadarr[$i])
		  {
			$year_path .= $imagepathuploadarr[$i]."/";
			  if (!file_exists($year_path)){
				  mkdir($year_path, 0777);
			  }     
			  mkdir($destination_path, 0777);
	 		}
	  }
	  
     /* $year_path = ABSPATH . "wp-content/uploads/".$today['year']."/";
      if (!file_exists($year_path)){
          mkdir($year_path, 0777);
      }     
      mkdir($destination_path, 0777);*/
   }
   $result = 0;
   
  // $digital_product_path = $General->get_digital_productpath();
	if($digital_product_path == '')
	{
		$digital_product_path = 'data_images';
	}
	$digital_destination_path = ABSPATH . "$upload_folder_path".$digital_product_path."/";
	
	$imagepathuploadarr = array();
	if (!file_exists($digital_destination_path)){
      $imagepathuploadarr = explode('/',$digital_product_path);
	   $upload_path = ABSPATH . "$upload_folder_path";
	  if (!file_exists($upload_path)){
		mkdir($upload_path, 0777);
	  }
	  for($i=0;$i<count($imagepathuploadarr);$i++)
	  {
		  if($imagepathuploadarr[$i])
		  {
			  $year_path = ABSPATH . "$upload_folder_path".$imagepathuploadarr[$i]."/";
			  if (!file_exists($year_path)){
				  mkdir($year_path, 0777);
			  }     
			  mkdir($digital_product_path, 0777);
	 		}
	  }
   }
   $result = 0;
	
   
   $name = time().'_'.$_FILES['myfile']['name'];
   $name = strtolower($name);
   /* $name = str_replace(" ", "_", $name);
   preg_match("/(.*)\.(.*)/", $name, $matches);
    $stem = $matches[1];
    $extension = $matches[2];
   $filetypes = array("jpg", "jpeg", "bmp", "gif", "png");
   
   if (!in_array($extension, $filetypes)){ 
   $user_path = "Not an allowed File type!";  ?>
     <script language="javascript" type="text/javascript">window.parent.window.noUpload(<?php echo $result.", '".$user_path."'"; ?>);</script>   
    <?php  die;
   }*/
   if(strstr($_GET['img'],'digital_product')) // digital products
   {
   		$target_path = $digital_destination_path . $name;
		$user_path = get_option( 'siteurl' ) ."/$upload_folder_path".$digital_product_path."/".$name;
   }else
   {
   		$target_path = $destination_path . $name;
		$user_path = get_option( 'siteurl' ) ."/$upload_folder_path".$imagepathupload."/".$name;
   }
  // $target_path = $destination_path . $name;
   //This tells the user where they've just uploaded the image to
  // $user_path = get_option( 'siteurl' ) ."/wp-content/uploads/".$today['year']."/".$today['month']."/".$name;
 
	
   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
      $result = 1;
	  //if true, good; if false, zip creation failed
	
             
   }
   sleep(1);
   
   /* creates a compressed zip file */
   $imgNumb = "image".$_GET['img'];
   
   list($width, $height) = getimagesize($user_path); 
?>
<script language="javascript" type="text/javascript">window.parent.window.noUpload(<?php echo $result.", '".$user_path."', '".$_GET['img']."', '".$width."', '".$height."' "; ?>);</script>