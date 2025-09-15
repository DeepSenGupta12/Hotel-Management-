<?php
session_start();
include "include/config.php";
include "include/function.php";

if($_SESSION['id'] == '')
{
    echo "<script>location.replace('login')</script>";
    //break;
}
$url = strtok($_SERVER['REQUEST_URI'],".");
$id = substr($url, strrpos($url, '/') + 1);

if(isset($_GET['delid']))
{
    $foodList = foodList($mysqli,$_GET['delid']);
    unlink('../assets/food/'.$foodList['images']);
    $delete = mysqli_query($mysqli,"delete from `food_details` where `id` = '".$foodList['id']."'");
    header('Location: '.$link.'/food_list/'.$foodList['f_id']);
}
$foodCat = foodCat($mysqli,$id);
$fetchData_rec = mysqli_query($mysqli,"select * from `food_details` where `f_id`='".$foodCat['id']."' order by `id` desc");
$fetchCount = mysqli_num_rows($fetchData_rec);

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
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">FOOD LIST <span style="color:green">[<?php echo strtoupper($foodCat['title']);?>]</span></h4>
                                   <p class="card-subtitle card-subtitle-dash">Total Images [<?php echo $fetchCount;?>]</p>
                                  </div>
                                  <div>
                                    <a href="<?php echo $link;?>/food_menu" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="fa fa-plus"></i>ADD FOOD</a>
                                    <a href="<?php echo $link;?>/food_category" class="btn btn-warning btn-lg text-white mb-0 me-0" type="button"><i class="fa fa-eye"></i>VIEW FOOD CATEGORY</a>
                                  </div>
                                </div>
                                <?php echo alertNotification($_SESSION['msg']);?>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                      
                                        <th width="10%">SL NO</th>
                                        <th width="40%">TITLE</th>
                                        <th width="40%">IMAGES</th>
                                        <th width="10%">Action</th>
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
                                        <div class="d-flex ">
                                            <div>
                                              <h6><?php echo $i;?></h6>
                                            
                                            </div>
                                          </div>
                                        </td>
                                        
                                        <td>
                                        <div class="d-flex ">
                                            <div>
                                              <h6><?php echo ucwords($fetchData_Res['title']);?></h6>
                                            
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                            <img style="width: 150px;height: auto;" src="<?php echo $sitelink;?>/assets/food/<?php echo $fetchData_Res['images'];?>" alt="">
                                            
                                            </div>
                                          </div>
                                        </td>
                                        
                                        <td>
                                        <div>
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2" style="">
                                        
                                        <a class="dropdown-item" onClick="deleteData('<?php echo $_SERVER['PHP_SELF'];?>?delid=<?php echo $fetchData_Res['id'];?>')">Delete</a>
                                       
                                      </div>
                                    </div>
                                  </div>
                                        </td>
                                      </tr>
                                      <?php
                                      $i++;
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

