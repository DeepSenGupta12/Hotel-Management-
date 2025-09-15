<?php
session_start();
include "include/config.php";
include "include/function.php";
if($_SESSION['id'] == '')
{
    echo "<script>location.replace('login')</script>";
    //break;
}
if(isset($_GET['delid']))
{
    $newsDetails = newsDetails($mysqli,$_GET['delid']);
    //echo $newsDetails['id'];exit;
    $deletePosition = mysqli_query($mysqli,"select * from `news_panel` where `nid`='".$newsDetails['id']."'");
    @unlink("../images/news/".$newsDetails['imageurl']);
    $delete = mysqli_query($mysqli,"delete from `news_details` where `id` = '".$newsDetails['id']."'");
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
$sql = "SELECT * FROM `news_details` ";
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
                                    <h4 class="card-title card-title-dash">VIEW NEWS</h4>
                                   <p class="card-subtitle card-subtitle-dash">List of News</p>
                                  </div>
                                  <div>
                                    <a href="<?php echo $link;?>/news_add" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="fa fa-plus"></i>ADD NEWS</a>
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
                                        <th width="15%">CATEGORY</th>
                                        <th width="5%">Images</th>
                                        <th width="70%">TITLE</th>
                                        <th width="10%">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php      
                                    $i=1;                                    
                                    while($fetchData_Res = mysqli_fetch_assoc($fetchData_rec))                                
                                    {
                                         $newsCatDetails = newsCatDetails($mysqli,$fetchData_Res['catid']);
                                         $userDetails = userDetails($mysqli,$fetchData_Res['loginid'])
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
                                              <h6><?php echo strtoupper($newsCatDetails['title']);?> | <?php echo strtoupper($fetchData_Res['language']);?></h6>
                                              <span style="color:green"><?php echo strtoupper($userDetails['username']);?></span>
                                            </div>
                                          </div>
                                        </td>
                                       
                                        <td><img src="<?php echo $sitelink;?>/images/news/<?php echo $fetchData_Res['imageurl'];?>" alt=""></td>
                                   
                                        <td><a style="text-decoration: underline;color:#1F3BB3; font-size:15px"><?php echo  mb_substr($fetchData_Res['title'],0,80,'utf-8');?></a></td>
                                        <td>
                                        <div>
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2" style="">
                                        <a class="dropdown-item" href="<?php echo $link;?>/news_add_images/<?php echo $fetchData_Res['id'];?>">Add</a>
                                        <a class="dropdown-item" href="<?php echo $link;?>/news_add/<?php echo $fetchData_Res['id'];?>">Edit</a>                                        
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

