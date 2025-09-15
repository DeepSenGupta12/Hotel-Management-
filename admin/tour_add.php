<?php 
session_start();
include "include/config.php";
include "include/function.php";

$client_name = strtok($_SERVER['HTTP_HOST'],".");
list($news,$admin,$id) = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
if(isset($id))
{
    $tourPlace = tourPlace($mysqli,$id);
}
if($_SESSION['id'] == '')
{
    echo "<script>location.replace('index')</script>";
    //break;
}
if($_SESSION['type'] != 'M')
{
  echo "<script>location.replace('index')</script>";
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
        $description = mysqli_real_escape_string($mysqli,html_entity_decode($_POST['description']));
        
        if($_POST['Submit'] == "Add Tour")
        {                 
                          
            $insertQuery = mysqli_query($mysqli,"insert into `tour_place`(`title`,`description`) values('".$title."','".$description."')");    
            $insid = mysqli_insert_id($mysqli);
            foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) 
            {
                $file_name=$_FILES["files"]["name"][$key];
                $file_tmp=$_FILES["files"]["tmp_name"][$key];
                $file_ext = strtolower(substr($file_name, strrpos($file_name, '.') + 1));
                $imageName = md5($file_name).time().".".$file_ext;
                move_uploaded_file($_FILES["files"]["tmp_name"][$key],"../assets/tour/".$imageName);
                resize(750,"../assets/tour/".$imageName,"../assets/tour/".$imageName);
                $tourImagesA = mysqli_query($mysqli,"insert into `tour_images`(`t_id`,`images`) values('".$insid."','".$imageName."')");
                   
               
            }    
            $_SESSION['last_action'] = time();
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Tour Places Added Successfully";
            header('Location: tour_add?task=success');
                    

        }
        else if($_POST['Submit'] == "Edit Tour")
        {          
            $updateTour = mysqli_query($mysqli,"update `tour_place` set `title`='".$title."',`description`='".$description."' where `id`='".$tourPlace['id']."'");
            $_SESSION['last_action'] = time();
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Tour Details Updated Successfully";
            header('Location: '.$link.'/tour_add/'.$tourPlace['id']);
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
                                    <h4 class="card-title card-title-dash">UPDATE NEAREST TOUR PLACES</h4>
                                   <p class="card-subtitle card-subtitle-dash">( ADD AND VIEW TOUR PLACES )</p>
                                  </div>
                                  
                                  <div>
                                    <a href="<?php echo $link;?>/tour_view" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button">VIEW TOUR PLACES</a>
                                  </div>
                                </div>
                                
             
                                <?php echo alertNotification($_SESSION['msg']);?>
                                  
                                <form class="row g-3" onsubmit="return validateForm()" id="add_news" method="post" enctype= multipart/form-data>
                                  
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">Tour Place Name</label>
                                                <input class="form-control" name="title" value="<?php echo $tourPlace['title'];?>" class="form-control" />
                                                <span id="nameErrMsg"></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">Tour Details</label>
                                                <textarea id="tour_desxc" class="form-control" style="height:200px" name="description"><?php echo $tourPlace['description'];?></textarea>
                                            </div>
                                            <?php
                                            if(!isset($id))
                                            {
                                            ?>
                                            <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Tour Images</label><br />
                                            <input style="clear:both" required type="file" id="files" name="files[]" multiple />
                                            </div>
                                            <?php
                                            }
                                            ?>

                                            <div class="col-md-12">
                                            <label for="inputFirstName" class="form-label">1. Tour place add / edit panel.</label><br />
                                            
                                            </div>
                                                                       
                                        <div class="col-12">
                                        <input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
                                        <input type="hidden" name="countBreakUp" id="countrow" value="<?php echo $countBreakUp;?>">
                                            <button type="submit" class="btn btn-primary text-white px-5" name="Submit" value="<?php if(isset($id)){echo "Edit Tour";}else{ echo "Add Tour";}?>">Save</button>
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

