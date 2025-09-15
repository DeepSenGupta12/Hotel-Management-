<?php
session_start();
include "include/config.php";
include "include/function.php";
include "include/request.php";
if($_SESSION['id'] == '')
{
    echo "<script>location.replace('login')</script>";
    //break;
}
if(isset($_GET['delid']))
{
    $roomFacility = roomFacility($mysqli,$_GET['delid']);
    @unlink('../assets/services/'.$roomFacility['images']);
    $delete = mysqli_query($mysqli,"delete from `room_facility` where `id` = '".$roomFacility['id']."'");
}


if(isset($_POST['Submit']))
{
    $csrf_token = make_safe($mysqli,$_POST['csrf_token']);
    if($csrf_token == $_SESSION['csrf_token'])
    {
        $fid = make_safe($mysqli,$_POST['fid']);
        $title = make_safe($mysqli,$_POST['title']);
        $roomFacility = roomFacility($mysqli,$fid);
        $file_name=$_FILES["img"]["name"];
        if($_POST['Submit'] == "Add Facility")
        {
            $insertFacility = mysqli_query($mysqli,"insert into `room_facility`(`title`) values('".$title."')");
            $insid = mysqli_insert_id($mysqli);
            if($file_name!='')
            {
              $file_ext = strtolower(substr($file_name, strrpos($file_name, '.') + 1));
              $newsImage = md5($file_name).time().".".$file_ext;
              move_uploaded_file($file_tmp=$_FILES["img"]["tmp_name"],"../assets/services/".$newsImage);
              //resize(750,"../assets/services/".$newsImage,"../assets/services/".$newsImage);
              $galleryIns = mysqli_query($mysqli,"UPDATE `room_facility` set `images`='".$newsImage."' where `id`='".$insid."'");
            }
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Facility Added Successfully";
            header('Location: room_facility?task=success');
        }
        else if($_POST['Submit'] == "Edit Facility")
        {
            $insertFacility = mysqli_query($mysqli,"update `room_facility` set `title`='".$title."' where `id`='".$roomFacility['id']."'");
            if($file_name!='')
            {
              @unlink('../assets/services/'.$roomFacility['images']);
              $file_ext = strtolower(substr($file_name, strrpos($file_name, '.') + 1));
              $newsImage = md5($file_name).time().".".$file_ext;
              move_uploaded_file($file_tmp=$_FILES["img"]["tmp_name"],"../assets/services/".$newsImage);
              //resize(750,"../assets/services/".$newsImage,"../assets/services/".$newsImage);
              $galleryIns = mysqli_query($mysqli,"UPDATE `room_facility` set `images`='".$newsImage."' where `id`='".$roomFacility['id']."'");
            }
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Facility Added Successfully";
            header('Location: room_facility?task=success');
        }
    }
    else
    {
        $_SESSION['task'] = "error";
        $_SESSION['msg'] = "Something Wrong !!";
        header('Location: room_facility?task=error');
    }
}



$sql = "SELECT * FROM `gallery_cat` ";
$fetchData_rec = mysqli_query($mysqli,$sql." order by `id` desc");
$fetchCount = mysqli_num_rows($fetchData_rec);

?>
<!DOCTYPE html>
<html lang="en">

<?php include "include/headertop.php";?>
<body>

<div id="modelPanel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content widget_content">
      
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
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">GALLERY CATEGORY</h4>
                                   <p class="card-subtitle card-subtitle-dash">List of category</p>
                                  </div>
                                  
                                </div>
                                <?php echo alertNotification($_SESSION['msg']);?>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th width="10%">
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </th>
                                        <th width="40%">TITLE</th>
                                        <th width="20%">STATUS</th>
                                        <th width="20%" style="text-align:right">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php      
                                    $i=1;                                    
                                    while($fetchData_Res = mysqli_fetch_assoc($fetchData_rec))                                
                                    {
                                         
                                    ?>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </td>
                                        
                                        <td>
                                          <div class="d-flex ">
                                            <!-- <img src="tableqrcode/<?php //echo checkImage($fetchData_Res['qrcode']);?>" alt=""> -->
                                            <div>
                                              <h6><?php echo strtoupper($fetchData_Res['title']);?></h6>
                                            
                                            </div>
                                          </div>
                                        </td>
                                        
                                        
                                        
                                        <td>
                                          <?php
                                          if($fetchData_Res['status'] == 'y')
                                          {
                                          ?>
                                        <div class="badge badge-opacity-success">Active</div>
                                        <?php
                                          }else{
                                        ?>
                                          <div class="badge badge-opacity-warning">In Active</div>
                                        <?php
                                          }
                                        ?>
                                        </td>
                                        <td style="text-align:right">
                                        <!-- <a href="<?php echo $link;?>/category_images/<?php echo $fetchData_Res['id'];?>" class="btn btn-primary btn-lg text-white mb-0 me-0">VIEW IMAGES</a> -->
                                        <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                        <div class="dropdown-menu" style="">
                                          <a class="dropdown-item" data-toggle="modal" data-target="#modelPanel" href="<?php echo $link;?>/widgets/addCategory/<?php echo $fetchData_Res['id'];?>"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                                          <a class="dropdown-item" href="<?php echo $link;?>/gallery_add_images/<?php echo $fetchData_Res['id'];?>" ><i class="fa fa-plus-circle"></i>&nbsp;Add Images</a>
                                          <a class="dropdown-item" href="<?php echo $link;?>/gallery_images/<?php echo $fetchData_Res['id'];?>"><i class="fa fa-eye"></i>&nbsp;View Images</a>
                                        
                                        </div>
                                      </div>
                                        </td>
                                      </tr>
                                      <?php
                                    }
                                      ?>
                                      
                                    </tbody>
                                  </table>
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

