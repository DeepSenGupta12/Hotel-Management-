<?php
session_start();
include "include/config.php";
include "include/function.php";

//include "include/chk_login.php";
if($_SESSION['id'] == '')
{
    echo "<script>location.replace('index')</script>";
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

$keyword = @$_GET['keyword'];
$checkin = $_GET['checkin'];
$checkout = $_GET['checkout'];
$flag = 0;
$sql = "SELECT * FROM `room_booking` ";
if($keyword)
{
    if($flag == 0)
    {
        $sql .= " where `booking_id` = '$keyword'";
        $flag = 1;
    }
    else
    {
        $sql .= " and `booking_id` = '$keyword'";
    }
}
if($checkin)
{
    if($flag == 0)
    {
        $sql .= " where (`checkin` BETWEEN '".$checkin."' AND '".$checkout."' OR `checkout` BETWEEN '".$checkin."' AND '".$checkout."')";
        $flag = 1;
    }
    else
    {
        $sql .= " and (`checkin` BETWEEN '".$checkin."' AND '".$checkout."' OR `checkout` BETWEEN '".$checkin."' AND '".$checkout."')";
    }
}

$sql.=" order by `id` desc";


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
                                    <h4 class="card-title card-title-dash">LIST OF BOOKING</h4>
                                  </div>
                                </div>
                                <div class="table-responsive  mt-1">
                                <form method="get">
                                  <div class="row" style="padding: 5px 0px;margin: 0px;border: 1px solid #CCC;">


                                  
                                                      <div class="col-md-3">
                                                      <label for="inputFirstName" class="form-label">No Type</label>
                                                      <input placeholder="search by booking Id" class="form-control" type="text" name="keyword" />

                                                      </div>
                                                      
                                                      <div class="col-md-3">
                                                      <label for="inputFirstName" class="form-label">Check In</label>
                                                      <div id="datepicker-popup" class="input-group chackindate date datepicker navbar-date-picker">
                                                      <span class="input-group-addon input-group-prepend border-right">
                                                      <span class="icon-calendar input-group-text calendar-icon"></span>
                                                      </span>
                                                      <input type="text" name="checkin" class="form-control chackindate" value="<?php echo $_GET['checkin'];?>">
                                                      </div>

                                                      </div>

                                                      <div class="col-md-3">
                                                      <label for="inputFirstName" class="form-label">Check In</label>
                                                      <div id="datepicker-popup" class="input-group chackindate date datepicker navbar-date-picker">
                                                      <span class="input-group-addon input-group-prepend border-right">
                                                      <span class="icon-calendar input-group-text calendar-icon"></span>
                                                      </span>
                                                      <input type="text" name="checkout" class="form-control chackindate" value="<?php echo $_GET['checkout'];?>">
                                                      </div>

                                                      </div>


                                                      <div class="col-md-2">
                                                      <label for="inputFirstName" class="form-label">Room Search</label>
                                                      <button type="submit" class="btn btn-primary text-white px-5" name="Submit" value="<?php if(isset($id)){echo "Edit Room";}else{ echo "Create Romm";}?>">Check</button>

                                                      </div>
                                          
                                                     
                                            </div> </form>
                                <table class="table select-table">
                                    <thead>
                                    
                                      <tr>
                                        <th width="5%">
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </th>
                                        <th width="10%">CUSTOMER DETAILS</th>
                                        <th width="10%">ROOM DETAILS</th>
                                        <th width="10%">CHECKIN / CHECKOUT</th>
                                        <th width="10%">BILLING</th>
                                        <th width="10%">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php      
                                    $i=1;
                                    $fetchData_rec = mysqli_query($mysqli,$sql);                                    
                                    while($fetchData_Res = mysqli_fetch_assoc($fetchData_rec))                                
                                    {
                                         $customerDetails = customerDetails($mysqli,$fetchData_Res['cid']);
                                         $roomDetails = roomDetails($mysqli,$fetchData_Res['room_id'])
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
                                              <h6><?php echo strtoupper($fetchData_Res['cname']);?> | <?php echo strtoupper($fetchData_Res['cmobile']);?><br />
                                              BOOKING ID: <span style="color:red">[<?php echo strtoupper($fetchData_Res['booking_id']);?>]</span>
                                            </h6>
                                            
                                            </div>
                                          </div>
                                        </td>
                                        
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                              <h6><?php echo strtoupper($roomDetails['title']);?> <br />
                                              NO OF ROOMS: <span style="color:red">[<?php echo strtoupper($fetchData_Res['no_room']);?>]</span></h6>
                                            </div>
                                          </div>
                                        </td>
                                   
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                              <h6>CHECK IN: <span style="color:red">[<?php echo strtoupper($fetchData_Res['checkin']);?>]</span> <br />
                                              CHECK OUT: <span style="color:red">[<?php echo strtoupper($fetchData_Res['checkout']);?>]</span></h6></div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                              <h6><span style="color:red; font-size:25px"><i class="fa fa-inr"></i>&nbsp;<?php echo strtoupper($roomDetails['price'] * $fetchData_Res['no_room']);?>&nbsp;/-</span></h6></div>
                                          </div>
                                        </td>
                                        <td style="text-align:right">
                                       
                                        <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                        <div class="dropdown-menu" style="">
                                          <a class="dropdown-item" target="_blank" href="<?php echo $link;?>/invoice/"><i class="fa fa-print"></i>&nbsp;Print</a>
                                          <a class="dropdown-item" href="#"><i class="fa fa-download"></i>&nbsp;Download</a>
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
                      <!-- <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                      <h4 class="card-title card-title-dash">Todo list</h4>
                                      <div class="add-items d-flex mb-0">
                                       
                                        <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                                      </div>
                                    </div>
                                    <div class="list-wrapper">
                                      <ul class="todo-list todo-list-rounded">
                                        <li class="d-block">
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3">24 June 2020</div>
                                              <div class="badge badge-opacity-warning me-3">Due tomorrow</div>
                                              <i class="mdi mdi-flag ms-2 flag-color"></i>
                                            </div>
                                          </div>
                                        </li>
                                        <li class="d-block">
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3">23 June 2020</div>
                                              <div class="badge badge-opacity-success me-3">Done</div>
                                            </div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3">24 June 2020</div>
                                              <div class="badge badge-opacity-success me-3">Done</div>
                                            </div>
                                          </div>
                                        </li>
                                        <li class="border-bottom-0">
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3">24 June 2020</div>
                                              <div class="badge badge-opacity-danger me-3">Expired</div>
                                            </div>
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                      
                      
                      </div> -->
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

