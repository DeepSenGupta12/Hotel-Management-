<?php
session_start();
include "include/config.php";
include "include/function.php";

if($_SESSION['id'] == '')
{
    echo "<script>location.replace('login')</script>";
    //break;
}
$client_name = strtok($_SERVER['HTTP_HOST'],".");
list($n,$news,$pagename,$id) = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
if(isset($id))
{
    $roomDetails = roomDetails($mysqli,$id);
}
if(isset($_GET['delid']))
{
    unlink('../assets/roomimages/'.$newsMoreImages['images']);
    $delete = mysqli_query($mysqli,"delete from `room_images` where `id` = '".$_GET['delid']."'");
    header('Location: '.$link.'/room_view_images/'.$_GET['roomid']);
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
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">ROOM AVAILIBILITY CHECK</h4>
                                   <p class="card-subtitle card-subtitle-dash">List of available rooms</p>
                                  </div>
                                 
                                </div>
                                <?php echo alertNotification($_SESSION['msg']);?>
                                <div class="table-responsive  mt-1">
                                <form method="get">
                                  <div class="row" style="padding: 5px 0px;margin: 0px;border: 1px solid #CCC;">


                                  
                                                      <div class="col-md-3">
                                                      <label for="inputFirstName" class="form-label">No Type</label>
                                                      <select class="form-control" name="room_id" id="">
                                                      <option value="">All</option>
                                                      <?php
                                                      $selectRoom = mysqli_query($mysqli,"select * from `room_category` order by `id` ASC");
                                                      while($selectRoomRes = mysqli_fetch_assoc($selectRoom))
                                                      {
                                                      ?>
                                                      <option <?php if($selectRoomRes['id'] == $_GET['room_id']){?>selected<?php }?> value="<?php echo $selectRoomRes['id'];?>"><?php echo strtoupper($selectRoomRes['title']);?></option>
                                                      <?php
                                                      }
                                                      ?>
                                                      </select>

                                                      </div>
                                                      <?php
                                                      /* 
                                                      ?><div class="col-md-2">
                                                      <label for="inputFirstName" class="form-label">No of rooms</label>
                                                      <select class="form-control" name="no_room" id="">
                                                      <option value="">Select One</option>
                                                      <?php
                                                      for($i=1;$i<=50;$i++)
                                                      {
                                                      ?>
                                                      <option <?php if($roomDetails['no_room'] == $i){?>selected<?php }?> value="<?php echo $i;?>"><?php echo $i;?></option>
                                                      <?php
                                                      }
                                                      ?>
                                                      </select>

                                                      </div>
                                                      <?php
                                                      
                                                      */
                                                      ?>
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
                                      
                                        <th width="5%">SL NO</th>
                                        <th width="20%">IMAGES</th>
                                        <th width="20%">TITLE</th>
                                        <th width="20%">ROOM AVAILABLE</th>
                                        <th width="20%">FACILITY</th>
                                        <th width="20%">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php      
                                    $i=1;
                                    $room_id = make_safe($mysqli,$_GET['room_id']);
                                    $checkin = make_safe($mysqli,$_GET['checkin']);
                                    $checkout = make_safe($mysqli,$_GET['checkout']); 

                                    $flag = 0;
                                    $sql = "select * from `room_category`";
                                    if($room_id)
                                    {
                                        if($flag == 0)
                                        {
                                            $sql .= " where `id` = '$room_id'";
                                            $flag = 1;
                                        }
                                        else
                                        {
                                            $sql .= " and `id` = '$room_id'";
                                        }
                                    }
                                    //echo $sql;
                                    $fetchData_rec = mysqli_query($mysqli,$sql." order by `id` desc");
                                    //$fetchCount = mysqli_num_rows(mysqli_query($mysqli,$sql));                                   
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
                                            <img style="width: 150px;height: auto;" src="<?php echo $sitelink;?>/assets/roomimages/<?php echo $fetchData_Res['images'];?>" alt="">
                                            
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                        <div class="d-flex ">
                                            <div>
                                              <h6><?php echo strtoupper($fetchData_Res['title']);?></h6><br />
                                              <h5 style="color:red"><i class="fa fa-inr"></i>&nbsp;<?php echo strtoupper($fetchData_Res['price']);?>/-</h5>
                                            
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                        <div class="d-flex ">
                                          <?php
                                          
                                          if($fetchData_Res['type'] == 'r')
                                          {
                                            $roomAvailibilityCheck = roomAvailibilityCheck($mysqli,$fetchData_Res['id'],$checkin,$checkout);
                                          
                                          ?>
                                            <div>
                                              <span style="color:black; font-size:14px; font-weight:bold">Total Room</span>
                                              <h2><?php echo strtoupper($fetchData_Res['no_room']);?></h2>
                                              <span style="color:red; font-size:14px; font-weight:black">Room Booking</span>
                                              <h2><?php echo $roomAvailibilityCheck;?>
                                              </h2>
                                              <span style="color:green; font-size:14px; font-weight:black">Room Available</span>
                                              <h2><?php 
                                              echo $fetchData_Res['no_room']-$roomAvailibilityCheck;
                                              ?>
                                              </h2>
                                            
                                            </div>
                                            <?php
                                          }else{
                                            $hallAvailibilityCheck = hallAvailibilityCheck($mysqli,$fetchData_Res['id'],$checkin,$checkout);
                                            if($hallAvailibilityCheck>0)
                                            {
                                                ?>
                                              <a type="submit" class="btn btn-warning text-white px-5">BOOKED</a>
                                                <?php
                                             }
                                             else{
                                              ?>

                                            <a type="submit" class="btn btn-success text-white px-5">AAVAILABLE</a>
                                            <?php
                                             }
                                             }
                                            ?>
                                          </div>
                                        </td>
                                        <td>
                                        <div class="d-flex ">
                                            <div>
                                              <?php
                                            
                                              $roomFacilityDetails = roomFacilityDetails($mysqli,$fetchData_Res['id']);
                                              foreach($roomFacilityDetails as $key=>$room_f)
                                              {
                                                  $roomFacility = roomFacility($mysqli,$room_f['f_id']);
                                              ?>
                                              <h6>  <?php echo round($key+1)."&nbsp;&nbsp;".strtoupper($roomFacility['title']);?></h6>
                                              <?php
                                              
                                              }
                                              ?>
                                            
                                            </div>
                                          </div>
                                        </td>
                                        
                                        <td>
                                        <div>
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2" style="">
                                        <a class="dropdown-item" href="<?php echo $link;?>/room_create/<?php echo $fetchData_Res['id'];?>">Edit</a>
                                        <a class="dropdown-item" href="<?php echo $link;?>/room_add_images/<?php echo $fetchData_Res['id'];?>">Add More</a>
                                        <a class="dropdown-item" onClick="deleteData('<?php echo $_SERVER['PHP_SELF'];?>?delid=<?php echo $fetchData_Res['id']; ?>')">Delete</a>
                                       
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

