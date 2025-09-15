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
$devider = 50;
if(isset($_GET['page']))
{
  $offset = round($_GET['page']*$devider-$devider);
}
else{
  $offset = 0;
}
$keyword = @$_GET['keyword'];
$flag = 0;
$sql = "SELECT * FROM `user_details` ";
if($keyword)
{
    if($flag == 0)
    {
        $sql .= " where `email` like '%$keyword%' or `mobile` like '%$keyword%'";
        $flag = 1;
    }
    else
    {
        $sql .= " and `email` like '%$keyword%' or `mobile` like '%$keyword%'";
    }
}
//echo $sql;
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
                                    <h4 class="card-title card-title-dash">VIEW CUSTOMER</h4>
                                   <p class="card-subtitle card-subtitle-dash">List of Customers</p>
                                  </div>
                                </div>
                                <?php echo alertNotification($_SESSION['msg']);?>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <td colspan="9"><form method="get">
                                        <input placeholder="search by email or mobile" class="form-control" type="text" name="keyword" style="width: 400px;float:left"/>
                                        <button name="Search"type="submit" value="Search" style="width:10%; height: 30px;background-color: black;
                                        color: white; border-radius : 4px">Search</button>
                                        </form></td>
                                      </tr>
                                      <tr>
                                        
                                        <th width="14%">CUSTOMER NAME</th>
                                        <th width="14%">MOBILE</th>
                                        <th width="14%">EMAIL</th>
                                        <th width="14%">COUNTRY</th>
                                        <th width="14%">STATE</th>
                                        <th width="14%">CITY</th>
                                        <th width="10%">ACTION</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $i = 1;           
                                              
                                    while($fetchData_Res = mysqli_fetch_assoc($fetchData_rec))                                
                                    {
                                         
                                    ?>
                                      <tr>
                                        <td>
                                          <div class="d-flex ">
                                            <!-- <img src="tableqrcode/<?php //echo checkImage($fetchData_Res['qrcode']);?>" alt=""> -->
                                            <div>
                                              <h6><?php echo strtoupper($fetchData_Res['fullname']);?></h6>
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
                                              <h6><?php echo $fetchData_Res['email'];?></h6>
                                            
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                              <h6><?php echo $fetchData_Res['country'];?></h6>
                                            
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                              <h6><?php echo $fetchData_Res['state'];?></h6>
                                            
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                              <h6><?php echo $fetchData_Res['city'];?></h6>
                                            
                                            </div>
                                          </div>
                                        </td>
                                        <td style="text-align:right">
                                        <!-- <a href="<?php echo $link;?>/category_images/<?php echo $fetchData_Res['id'];?>" class="btn btn-primary btn-lg text-white mb-0 me-0">VIEW IMAGES</a> -->
                                        <div class="d-flex input-group-prepend">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                        <div class="dropdown-menu" style="">
                                          <a class="dropdown-item" href="<?php echo $link;?>/tour_add/<?php echo $fetchData_Res['id'];?>"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                                          <a class="dropdown-item" onclick="deleteData('<?php echo $link;?>/tour_view?delid=<?php echo $fetchData_Res['id'];?>')"><i class="fa fa-trash-o"></i>&nbsp;Delete</a>
                                          <a class="dropdown-item" href="<?php echo $link;?>/tour_add_images/<?php echo $fetchData_Res['id'];?>" ><i class="fa fa-plus-circle"></i>&nbsp;Add Images</a>
                                          <a class="dropdown-item" href="<?php echo $link;?>/tour_images/<?php echo $fetchData_Res['id'];?>"><i class="fa fa-eye"></i>&nbsp;View Images</a>
                                        
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

