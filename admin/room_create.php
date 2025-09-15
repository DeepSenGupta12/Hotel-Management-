<?php 
session_start();
include "include/config.php";
include "include/function.php";
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
$client_name = strtok($_SERVER['HTTP_HOST'],".");
$pros = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
$id = $pros[3]; 

if(isset($id))
{
    $roomDetails = roomDetails($mysqli,$id);
}
if($_SESSION['id'] == '')
{
  header('Location: '.$link.'/index');
    //break;
}
if(empty($_SESSION['csrf_token'])) 
{
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['csrf_token'];
if(isset($_POST['Submit']))
{   
  
    $csrf_token = make_safe($mysqli,$_POST['csrf_token']);

    if($csrf_token == $token)
    {
        $title = make_safe($mysqli,$_POST['title']);
        $price = make_safe($mysqli,$_POST['price']);
        $no_room = make_safe($mysqli,$_POST['no_room']);
        $file_name=$_FILES["img"]["name"];
        $f_id = $_POST['f_id'];
        
        if($_POST['Submit'] == "Create Romm")
        {                 
                          
            $insertQuery = mysqli_query($mysqli,"insert into `room_category`(`title`,`price`,`no_room`) values('".$title."','".$price."','".$no_room."')");    
            $insid = mysqli_insert_id($mysqli);
            if($file_name!='')
            {
              $file_ext = strtolower(substr($file_name, strrpos($file_name, '.') + 1));
              $newsImage = md5($file_name).time().".".$file_ext;
              move_uploaded_file($file_tmp=$_FILES["img"]["tmp_name"],"../assets/roomimages/".$newsImage);
              resize(1024,"../assets/roomimages/".$newsImage,"../assets/roomimages/".$newsImage);
              $galleryIns = mysqli_query($mysqli,"UPDATE `room_category` set `images`='".$newsImage."' where `id`='".$insid."'");
            }
            foreach($f_id as $value)
            {
                $insertFacility = mysqli_query($mysqli,"insert into `room_facility_set`(`room_id`,`f_id`) values('".$insid."','".$value."')");
            }       
            $_SESSION['last_action'] = time();
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Room Added Successfully";
            header('Location: room_create?task=success');
                    

        }
        else if($_POST['Submit'] == "Edit Room")
        {
          
            $updateRoom = mysqli_query($mysqli,"update `room_category` set `title`='".$title."',`price`='".$price."',`no_room`='".$no_room."' where `id`='".$roomDetails['id']."'");
            if($file_name!='')
            {
              @unlink('../assets/roomimages/'.$roomDetails['images']);
              $file_ext = strtolower(substr($file_name, strrpos($file_name, '.') + 1));
              $newsImage = md5($file_name).time().".".$file_ext;
              move_uploaded_file($_FILES["img"]["tmp_name"],"../assets/roomimages/".$newsImage);
              resize(1024,"../assets/roomimages/".$newsImage,"../assets/roomimages/".$newsImage);
              $galleryIns = mysqli_query($mysqli,"UPDATE `room_category` set `images`='".$newsImage."' where `id`='".$roomDetails['id']."'");
            }
            $deleteFacility = mysqli_query($mysqli,"delete from `room_facility_set` where `room_id`='".$roomDetails['id']."'");

            foreach($f_id as $value)
            {
                $insertFacility = mysqli_query($mysqli,"insert into `room_facility_set`(`room_id`,`f_id`) values('".$roomDetails['id']."','".$value."')");
            } 
            $_SESSION['last_action'] = time();
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Room Updated Successfully";
            header('Location: '.$link.'/room_create/'.$roomDetails['id']);
        }
    }
    else
    {
        $_SESSION['task'] = "error";
        $_SESSION['msg'] = "Something Wrong !!";
        header('Location: news_add?task=error');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "include/headertop.php";?>
<body>
  <div class="container-scroller"> 
    <!-- partial:partials/_navbar.html -->
    <?php include "include/header.php";?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        
      </div>
     
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php include "include/leftpanel.php";?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">

              <?php //include "include/hometab.php";?>







                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                 
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                              <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">CREATE ROOM</h4>
                                   <p class="card-subtitle card-subtitle-dash">( ADD AND VIEW ROOM )</p>
                                  </div>
                                  
                                  <div>
                                    <a href="<?php echo $link;?>/room_view" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button">VIEW ROOM</a>
                                  </div>
                                </div>
                                
             
                                <?php
                               
                                echo alertNotification($_SESSION['msg']);?>
                                  
                                <form class="row g-3" onsubmit="return validateForm()" id="add_news" method="post" enctype= multipart/form-data>
                                        
                                        
                                      <script>
                                        function isNumber(evt) {
                                              evt = (evt) ? evt : window.event;
                                              var charCode = (evt.which) ? evt.which : evt.keyCode;
                                              if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                                  return false;
                                              }
                                              return true;
                                            }
                                      </script>

                                       
                                        
                                            <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label">Title</label>
                                                <input class="form-control" onkeypress="CheckSpace(event)" name="title" value="<?php echo $roomDetails['title'];?>" class="form-control" />
                                                <span id="nameErrMsg"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label">Price</label>
                                                <input class="form-control" name="price" maxlength="10" id="mobile" onkeypress="return isNumber(event)" required value="<?php echo $roomDetails['price'];?>" class="form-control" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label">No of rooms</label>
                                                <select class="form-control" name="no_room" id="">
                                                  <option value="">Select One</option>
                                                  <?php
                                                  for($i=0;$i<=50;$i++)
                                                  {
                                                  ?>
                                                  <option <?php if($roomDetails['no_room'] == $i){?>selected<?php }?> value="<?php echo $i;?>"><?php echo $i;?></option>
                                                  <?php
                                                  }
                                                  ?>
                                                </select>
                                                
                                            </div>
                                            
                                             <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label">Room Image</label>
                                                <input type="file" class="form-control" name="img" style="line-height: 2px;" />
                                                <?php
                                                if(isset($id))
                                                {
                                                ?>
                                                <img style="width:100px; margin-top:5px; padding:5px; border:1px solid #222" src="<?php echo $sitelink;?>/assets/roomimages/<?php echo $roomDetails['images'];?>" alt="">
                                                <?php
                                                }
                                                ?>
                                            </div>

                                            <?php
                                            $i=1;
                                            $facility = mysqli_query($mysqli,"select * from `room_facility` order by id asc");
                                            while($facilityRes = mysqli_fetch_assoc($facility))
                                            {
                                                $roomFacilitySet = roomFacilitySet($mysqli,$roomDetails['id'],$facilityRes['id']);
                                               
                                            ?>
                                            <div class="col-md-6">
                                            <input type="checkbox" <?php if($roomFacilitySet['f_id'] == $facilityRes['id']){?>checked="checked"<?php }?> name="f_id[]" value="<?php echo $facilityRes['id'];?>">&nbsp;&nbsp;
                                            <label for="inputFirstName" class="form-label"><?php echo strtoupper($facilityRes['title']);?></label>
                                            </div>
                                            <?php
                                            $i++;
                                            }
                                            ?>
                                            
                                            
                                            <div class="col-md-12">
                                            <label for="inputFirstName" class="form-label">1. Room add / edit panel.</label><br />
                                            <label for="inputFirstName" class="form-label"> 2. Room price must have intiger format.</label>
                                            
                                            </div>
                                                                       
                                        <div class="col-12">
                                        <input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
                                        <input type="hidden" name="countBreakUp" id="countrow" value="<?php echo $countBreakUp;?>">
                                            <button type="submit" class="btn btn-primary text-white px-5" name="Submit" value="<?php if(isset($id)){echo "Edit Room";}else{ echo "Create Romm";}?>">Save</button>
                                        </div>
                                    </form>
                                
                              
                              
                              
                              
                                  </div>
                            </div>
                          </div>
                        </div>
                      </div>
                     
                    </div>
                 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include "include/footer.php";?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->

  <!-- End custom js for this page-->
</body>

</html>

