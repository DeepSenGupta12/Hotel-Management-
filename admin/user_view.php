<?php
session_start();
include "include/config.php";
include "include/function.php";
if($_SESSION['id'] == '')
{
    echo "<script>location.replace('login')</script>";
    //break;
}
if($_SESSION['type'] != 'M')
{
  echo "<script>location.replace('index')</script>";
}
if(isset($_GET['delid']))
{
    $delete = mysqli_query($mysqli,"delete from `master_panel` where `id` = '".$_GET['delid']."'");
}
$devider = 50;
if(isset($_GET['page']))
{
  $offset = round($_GET['page']*$devider-$devider);
}
else{
  $offset = 0;
}
$keyword = @$_GET['keyword'];
$classid = @$_GET['classid'];
$flag = 0;
$sql = "SELECT * FROM `master_panel` ";
if($keyword)
{
    if($flag == 0)
    {
        $sql .= " where `name` like '%$keyword%' or `mobile` like '%$keyword%'";
        $flag = 1;
    }
    else
    {
        $sql .= " and `name` like '%$keyword%' or `mobile` like '%$keyword%'";
    }
}
if($classid)
{
    if($flag == 0)
    {
        $sql .= " where `classid` = '$classid'";
        $flag = 1;
    }
    else
    {
        $sql .= " and `classid` = '$classid'";
    }
}
$fetchData_rec = mysqli_query($mysqli,$sql." order by `id` desc");
$fetchCount = mysqli_num_rows(mysqli_query($mysqli,$sql));

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
                                    <h4 class="card-title card-title-dash">VIEW USER</h4>
                                   <p class="card-subtitle card-subtitle-dash">List of User</p>
                                  </div>
                                  <div>
                                    <a href="<?php echo $link;?>/user_create" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="fa fa-plus"></i>ADD USER</a>
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
                                        <th width="20%">USERNAME</th>
                                        <th width="20%">MOBILE</th>
                                        <th width="20%">PASSWORD</th>
                                        <th width="20%">STATUS</th>
                                        <th width="20%">Action</th>
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
                                              <h6><?php echo strtoupper($fetchData_Res['username']);?>&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo strtoupper($fetchData_Res['type']);?>]</h6>
                                            
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                              <h6><?php echo strtoupper($fetchData_Res['mobile']);?></h6>
                                            
                                            </div>
                                          </div>
                                        </td>
                                        
                                   
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                              <h6><?php echo $fetchData_Res['tmp_pass'];?></h6>
                                            
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
                                        <td>
                                        <div>
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2" style="">
                                        <a class="dropdown-item" href="<?php echo $link;?>/user_create/<?php echo $fetchData_Res['id'];?>">Edit</a>
                                        <a class="dropdown-item" onClick="deleteData('<?php echo $_SERVER['PHP_SELF'];?>?delid=<?php echo $fetchData_Res['id']; ?>')">Delete</a>
                                       
                                      </div>
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

