<?php 
session_start();
include "include/config.php";
include "include/function.php";
include "include/request.php";
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
           
            $extension=array("jpeg","jpg");
            $g_id = make_safe($mysqli,$_POST['g_id']);
            foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) 
            {
                $file_name=$_FILES["files"]["name"][$key];
                $file_tmp=$_FILES["files"]["tmp_name"][$key];
                $ext=pathinfo($file_name,PATHINFO_EXTENSION);

                $file_ext = strtolower(substr($file_name, strrpos($file_name, '.') + 1));
                $imageName = md5($file_name).time().".".$file_ext;
                move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../assets/gallery/".$imageName);
                resize(750,"../assets/gallery/".$imageName,"../assets/gallery/".$imageName);
                echo "insert into `gallery_images`(`g_id`,`images`) values('".$g_id."','".$imageName."')";
                $galleryIns = mysqli_query($mysqli,"insert into `gallery_images`(`g_id`,`images`) values('".$g_id."','".$imageName."')");
                   
               
            }
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Gallery Added Successfully";
            header('Location: '.$link.'/gallery_add/?task=success'); 
              
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
<div id="modelPanel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
    </div>

  </div>
</div>
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
                                    <h4 class="card-title card-title-dash">ADD GALLERY</h4>
                                   <p class="card-subtitle card-subtitle-dash">( GALLERY ADD AND UPDATE )</p>
                                  </div>
                                  
                                  <div>
                                    <a data-toggle="modal" data-target="#modelPanel" href="<?php echo $link;?>/widgets/addCategory" class="btn btn-warning btn-lg text-white mb-0 me-0" type="button"><i class="fa fa-plus-circle"></i>&nbsp;ADD CATEGORY</a>
                                    <a href="<?php echo $link;?>/gallery_view" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="fa fa-eye"></i>&nbsp;VIEW CATEGORY</a>
                                  </div>
                                </div>
                                
             
                                <?php echo alertNotification($_SESSION['msg']);?>
                                  
                                <form class="row g-3" id="add_news" method="post" enctype="multipart/form-data">
                                      


                                        
                                  <div class="col-md-6">
                                  <div class="form-group">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gallery Cat</button>
                                        <div class="dropdown-menu" style="">
                                          <a class="dropdown-item" data-toggle="modal" data-target="#modelPanel" href="<?php echo $link;?>/widgets/addCategory" ><i class="fa fa-plus-circle"></i>&nbsp;Add Category</a>
                                          <a class="dropdown-item" href="<?php echo $link;?>/gallery_view"><i class="fa fa-eye"></i>&nbsp;View Category</a>
                                        
                                        </div>
                                      </div>
                                      <select class="form-control" name="g_id" id="">
                                        <option value="">Select One</option>
                                        <?php
                                        $galleryCat = mysqli_query($mysqli,"select * from `gallery_cat` order by `id` desc");
                                        while($galleryCatRes = mysqli_fetch_assoc($galleryCat))
                                        {
                                        ?>
                                        <option <?php if($roomDetails['no_room'] == $i){?>selected<?php }?> value="<?php echo ucwords($galleryCatRes['id']);?>"><?php echo ucwords($galleryCatRes['title']);?></option>
                                        <?php
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>

                                      
                                  
                                  </div>
                                            
                                  <div class="col-md-6">
                                  <label for="inputFirstName" class="form-label">Upload News Image</label><br />
                                  <label for="inputFirstName" class="form-label">1. You can uploaded 4 extra images per news</label>
                                  <input style="clear:both" required type="file" id="files" name="files[]" multiple />
                                  
                                  </div>
                                         
                                                                       
                                        <div class="col-12">
                                        <input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
                                        <input type="hidden" name="countBreakUp" id="countrow" value="<?php echo $countBreakUp;?>">
                                            <button type="submit" class="btn btn-primary text-white px-5" name="Submit" value="<?php if(isset($id)){echo "Add Images";}else{ echo "Add Images";}?>">Save</button>
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

