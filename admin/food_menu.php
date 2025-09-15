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
        
        if($_POST['Submit'] == "Add Food")
        {
           
            $f_id = make_safe($mysqli,$_POST['f_id']);


            for($i=1;$i<=4;$i++)
            {
              $title = make_safe($mysqli,$_POST['title'.$i]);
              $codename = make_safe($mysqli,$_POST['codename'.$i]);
              $price = make_safe($mysqli,$_POST['price'.$i]);
              
              $file_name=$_FILES["files".$i]["name"];
              $file_tmp=$_FILES["files".$i]["tmp_name"];
              $ext=pathinfo($file_name,PATHINFO_EXTENSION);

              if($title!='')
              {
                $file_ext = strtolower(substr($file_name, strrpos($file_name, '.') + 1));
                $imageName = md5($file_name).time().".".$file_ext;
                move_uploaded_file($file_tmp,"../assets/food/".$imageName);
                resize(400,"../assets/food/".$imageName,"../assets/food/".$imageName);
                $galleryIns = mysqli_query($mysqli,"insert into `food_details`(`f_id`,`title`,`codename`,`price`,`images`) values('".$f_id."','".$title."','".$codename."','".$price."','".$imageName."')");
              }
            }
                    
                
              
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Food Added Successfully";
            header('Location: '.$link.'/food_menu?task=success');
          
              
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
                                    <h4 class="card-title card-title-dash">ADD FOOD MENU</h4>
                                   <p class="card-subtitle card-subtitle-dash">( FOOD MENU ADD AND UPDATE )</p>
                                  </div>
                                  
                                  <div>
                                    <a data-toggle="modal" data-target="#modelPanel" href="<?php echo $link;?>/widgets/addFoodCategory" class="btn btn-warning btn-lg text-white mb-0 me-0" type="button"><i class="fa fa-plus-circle"></i>&nbsp;ADD FOOD CATEGORY</a>
                                    <a href="<?php echo $link;?>/food_category" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="fa fa-eye"></i>&nbsp;VIEW CATEGORY</a>
                                  </div>
                                </div>
                                
             
                                <?php echo alertNotification($_SESSION['msg']);?>
                                  
                                <form class="row g-3" id="add_news" method="post" enctype="multipart/form-data">
                                      


                                        
                                  <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Food Category</button>
                                        <div class="dropdown-menu" style="">
                                          <a class="dropdown-item" data-toggle="modal" data-target="#modelPanel" href="<?php echo $link;?>/widgets/addFoodCategory" ><i class="fa fa-plus-circle"></i>&nbsp;Add Category</a>
                                          <a class="dropdown-item" href="<?php echo $link;?>/food_category"><i class="fa fa-eye"></i>&nbsp;View Category</a>
                                        
                                        </div>
                                      </div>
                                      <select class="form-control" name="f_id" id="">
                                        <option value="">Select One</option>
                                        <?php
                                        $foodCat = mysqli_query($mysqli,"select * from `food_cat` order by `id` desc");
                                        while($foodCatRes = mysqli_fetch_assoc($foodCat))
                                        {
                                        ?>
                                        <option <?php if($roomDetails['no_room'] == $i){?>selected<?php }?> value="<?php echo ucwords($foodCatRes['id']);?>"><?php echo ucwords($foodCatRes['title']);?></option>
                                        <?php
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>

                                      
                                  
                                  </div>

                                  <?php
                                  for($i=1;$i<=4;$i++)
                                  {
                                  ?>
                                  <div class="col-md-3">
                                      <label for="inputFirstName" class="form-label">Food Name</label>
                                      <input class="form-control" onkeypress="CheckSpace(event)" name="title<?php echo $i;?>" value="<?php echo $roomDetails['title'];?>" class="form-control" />
                                      <span id="nameErrMsg"></span>
                                  </div>

                                  <div class="col-md-3">
                                      <label for="inputFirstName" class="form-label">Code Name</label>
                                      <input class="form-control" onkeypress="CheckSpace(event)" name="codename<?php echo $i;?>" value="<?php echo $roomDetails['codename'];?>" class="form-control" />
                                      <span id="nameErrMsg"></span>
                                  </div>
                                  <div class="col-md-3">
                                      <label for="inputFirstName" class="form-label">Price</label>
                                      <input class="form-control" onkeypress="CheckSpace(event)" name="price<?php echo $i;?>" value="<?php echo $roomDetails['codename'];?>" class="form-control" />
                                      <span id="nameErrMsg"></span>
                                  </div>
                                            
                                  <div class="col-md-3">
                                  <label for="inputFirstName" class="form-label">Upload Food Image</label><br />
                                  <input style="clear:both" required type="file" name="files<?php echo $i;?>" />
                                  
                                  
                                  </div>
                                  <?php
                                  }
                                  ?>
                                                                       
                                        <div class="col-12">
                                        <input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
                                        <input type="hidden" name="countBreakUp" id="countrow" value="<?php echo $countBreakUp;?>">
                                            <button type="submit" class="btn btn-primary text-white px-5" name="Submit" value="<?php if(isset($id)){echo "Add Images";}else{ echo "Add Food";}?>">Save</button>
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

