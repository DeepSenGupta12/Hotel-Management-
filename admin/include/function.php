<?php
function siteSettings($mysqli)
{
	$fetchData = mysqli_query($mysqli,"select * from `hotel_settings` where `id` = 1");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function bookingDetails($mysqli,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `room_booking` where `booking_id` = '".$id."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function customerDetails($mysqli,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `user_details` where `id` = '".$id."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function tourPlace($mysqli,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `tour_place` where `id` = '".$id."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function tourImages($mysqli,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `tour_images` where `id` = '".$id."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function foodCat($mysqli,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `food_cat` where `id` = '".$id."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function foodList($mysqli,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `food_details` where `id` = '".$id."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function galleryCat($mysqli,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `gallery_cat` where `id` = '".$id."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function galleryImages($mysqli,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `gallery_images` where `id` = '".$id."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function roomMoreImages($mysqli,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `news_images` where `id` = '".$id."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function countImages($mysqli,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `news_images` where `nid` = '".$id."'");
	$fetchDataRes = mysqli_num_rows($fetchData);
	return $fetchDataRes;
}
function userDetails($mysqli,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `master_panel` where `id` = '".$id."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function roomDetails($mysqli,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `room_category` where `id` = '".$id."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function roomFacility($mysqli,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `room_facility` where `id` = '".$id."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function roomFacilitySet($mysqli,$roomid,$id)
{
	$fetchData = mysqli_query($mysqli,"select * from `room_facility_set` where `room_id`='".$roomid."' and `f_id` = '".$id."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}

function roomFacilityDetails($mysqli,$roomid)
{
	$facility = array();
	$fetchData = mysqli_query($mysqli,"select * from `room_facility_set` where `room_id`='".$roomid."'");
	while($fetchDataRes = mysqli_fetch_assoc($fetchData))
	{
		array_push($facility,$fetchDataRes);
	}
	return $facility;
}
function hallAvailibilityCheck($mysqli,$roomid,$checkin,$checkout)
{
	$count = mysqli_query($mysqli,"SELECT * FROM `room_booking` WHERE (`checkin` BETWEEN '".$checkin."' AND '".$checkout."' OR `checkout` BETWEEN '".$checkin."' AND '".$checkout."') AND `room_id` = '".$roomid."'");
	$countRes = mysqli_num_rows($count);
	return $countRes;
}
function roomAvailibilityCheck($mysqli,$roomid,$checkin,$checkout)
{
	$count = mysqli_query($mysqli,"SELECT SUM(`no_room`) as `count_room` FROM `room_booking` WHERE (`checkin` BETWEEN '".$checkin."' AND '".$checkout."' OR `checkout` BETWEEN '".$checkin."' AND '".$checkout."') AND `room_id` = '".$roomid."'");
	$countRes = mysqli_fetch_assoc($count);
	if($countRes['count_room'] == 0)
	{
		$c= 0;
	}
	else
	{
		$c= $countRes['count_room'];
	}
	return $c;
}
function totalUser($mysqli,$status)
{
	$flag = 0;
	$sql = "SELECT * FROM `master_panel` ";
	$type = 'M';
	if($type)
	{
		if($flag == 0)
		{
			$sql .= " where `type` != '$type'";
			$flag = 1;
		}
		else
		{
			$sql .= " and `type` != '$type'";
		}
	}
	if($status)
	{
		if($flag == 0)
		{
			$sql .= " where `status` = '$status'";
			$flag = 1;
		}
		else
		{
			$sql .= " and `status` = '$status'";
		}
	}
	//echo $sql;
	$fetchData = mysqli_query($mysqli,$sql);
	return mysqli_num_rows($fetchData);
}
function roomFacilities($mysqli,$fid)
{
	$fetchData = mysqli_query($mysqli,"select * from `room_facility` where `id` = '".$fid."'");
	$fetchDataRes = mysqli_fetch_assoc($fetchData);
	return $fetchDataRes;
}
function strReplace($string)
{
	return str_replace([':', '\\', '/','"','“','”', '*', ' ', '.',',','(',')',"'",'?',' ','just'], '-', strtolower($string));
}
function string_sanitize($s) {
    $result = preg_replace("/[^a-zA-Z0-9]+/", "-", html_entity_decode($s, ENT_QUOTES));
    return $result;
}
function make_safe($mysqli,$fiendName) 
{
   $fiendName = mysqli_real_escape_string($mysqli,htmlspecialchars(stripslashes(trim($fiendName))));
   return $fiendName; 
}

function resize($newWidth, $targetFile, $originalFile) {

    $info = getimagesize($originalFile);
    $mime = $info['mime'];

    switch ($mime) {
			case 'image/jpg':
				$image_create_func = 'imagecreatefromjpg';
				$image_save_func = 'imagejpg';
				$new_image_ext = 'jpg';
				break;
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
                    break;

            case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

            default: 
                    throw new Exception('Unknown image type.');
    }

    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);

    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($targetFile)) {
            unlink($targetFile);
    }
    $image_save_func($tmp, "$targetFile");
}

/////////////////////////////////////////////////////////////////
function alertNotification($msg)
{
	if(isset($_GET['task']) && $_GET['task'] == "error")
	{
	    
	    echo '<div class="alert alert-danger alert-dismissible">
		<!--<i class="fa fa-cloud-download alert-icon"></i>
		<button type="button" class="close" data-dismiss="alert">×</button>-->
		'.$msg.'
	  </div>';
	}
	else if(isset($_GET['task']) && $_GET['task'] == "info")
	{
		echo '<div class="alert alert-warning alert-dismissible">
		<!--<i class="fa fa-cloud-download alert-icon"></i>
		<button type="button" class="close" data-dismiss="alert">×</button>-->
		'.$msg.'
	  </div>';
	}
	else if(isset($_SESSION['task']) && $_SESSION['task'] == "success")
	{
		echo '<div class="alert alert-success alert-dismissible">
		<!--<i class="fa fa-home alert-icon"></i>
		<button type="button" class="close" data-dismiss="alert">×</button>-->
		'.$msg.'
	  </div>';
	  
	}
}
?>