<?php 
session_start();
include "include/config.php";
include "include/function.php";
$client_name = strtok($_SERVER['HTTP_HOST'],".");
$pros  = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
$id = $pros[3];

if(isset($id))
{
    $roomDetails = roomDetails($mysqli,$id);
}
if($_SESSION['id'] == '')
{
    echo "<script>location.replace('index')</script>";
    //break;
}
if(empty($_SESSION['csrf_token'])) 
{
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['csrf_token'];
if(isset($_POST['Submit']))
{
    
    $csrf_token = mysqli_real_escape_string($mysqli,$_POST['csrf_token']);

    if($csrf_token == $token)
    {
        if($_POST['Submit'] == "Add Images")
        {
           
            foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) 
            {
                $file_name=$_FILES["files"]["name"][$key];
                $file_tmp=$_FILES["files"]["tmp_name"][$key];
                $file_ext = strtolower(substr($file_name, strrpos($file_name, '.') + 1));
                $imageName = md5($file_name).time().".".$file_ext;
                move_uploaded_file($_FILES["files"]["tmp_name"][$key],"../assets/roomimages/".$imageName);
                resize(1024,"../assets/roomimages/".$imageName,"../assets/roomimages/".$imageName);
                $galleryIns = mysqli_query($mysqli,"insert into `room_images`(`room_id`,`images`) values('".$roomDetails['id']."','".$imageName."')");
                   
               
            }
            $_SESSION['last_action'] = time();
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Image Added Successfully";
            header('Location: '.$link.'/room_add_images/'.$roomDetails['id'].'?task=success'); 
              
        }
    }
    else
    {
        $_SESSION['task'] = "error";
        $_SESSION['msg'] = "Something Wrong !!";
        header('Location: add_client?task=error');
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
                                    <h4 class="card-title card-title-dash">ADD MORE IMAGES</h4>
                                   <p class="card-subtitle card-subtitle-dash">( NEWS ADD AND UPDATE )</p>
                                  </div>
                                  
                                  <div>
                                    <a href="<?php echo $link;?>/room_view_images/<?php echo $roomDetails['id'];?>" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button">VIEW IMAGES</a>
                                  </div>
                                </div>
                                
             
                                <?php echo alertNotification($_SESSION['msg']);?>
                                  
                                <form class="row g-3" id="add_news" method="post" enctype="multipart/form-data">
                                      


                                        
                                      
                                            
                                            <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Upload News Image</label><br />
                                            <input style="clear:both" required type="file" id="files" name="files[]" multiple />
                                            
                                            </div>
                                            
                                            <div class="col-md-12">
                                            <label for="inputFirstName" class="form-label">1. You can uploaded 4 images at a time</label>
                                            
                                            </div>
                                                                       
                                        <div class="col-12">
                                        <input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
                                        <input type="hidden" name="countBreakUp" id="countrow" value="<?php echo $countBreakUp;?>">
                                            <button type="submit" class="btn btn-primary text-white px-5" name="Submit" value="<?php if(isset($id)){echo "Add Images";}else{ echo "Create News";}?>">Save</button>
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

