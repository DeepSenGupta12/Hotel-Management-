<?php
session_start();
include "admin/include/config.php";
include "admin/include/function.php";
include "include/siteRequest.php";
if(isset($_GET['rooms'])) {$rooms = make_safe($mysqli,$_GET['rooms']);$_SESSION['rooms'] = $rooms;}else{$rooms = $_SESSION['rooms'];}
if(isset($_GET['checkin'])) {$checkin = make_safe($mysqli,$_GET['checkin']);$_SESSION['checkin'] = $checkin;}else{$checkin = $_SESSION['checkin'];}
if(isset($_GET['checkout'])) {$checkout = make_safe($mysqli,$_GET['checkout']);$_SESSION['checkout'] = $checkout;}else{$checkout = $_SESSION['checkout'];}
?>
<!doctype html>
<html lang="zxx">
<?php include "include/headertop.php";?>
    <body>
    <div id="modelPanel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
    </div>

  </div>
</div>
    <?php include "include/header.php";?>


        <!-- Inner Banner -->
        <div class="inner-banner inner-bg3">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="index.html">Home <?php echo $checkout;?></a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>Reservation</li>
                    </ul>
                    <h3>Reservation</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->
       
        <!-- Reservation widget Area -->
        <div class="reservation-widget-area">
            <div class="container">
                <div class="tab reservation-tab">
                    <!-- <ul class="tabs">
                        <li>
                            <a href="#">Hotel Room</a>
                        </li>

                        <li>
                            <a href="#">Conference</a>
                        </li>

                        <li>
                            <a href="#">Resort Reserve</a>
                        </li>

                        <li>
                            <a href="#">Weeding Hall</a>
                        </li>

                        <li>
                            <a href="#">Community Center</a>
                        </li>
                    </ul> -->

                    <div class="tab_content current active">
                        <div class="tabs_item current">
                            <div class="reservation-tab-item">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="side-bar-form">
                                            <h3>Booking Sheet </h3>
                                            <form action="reservation">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Check in</label>
                                                            <div class="input-group">
                                                                <input id="datetimepicker" type="text" name="checkin" class="form-control checkin_date" placeholder="" value="<?php echo $_SESSION['checkin'];?>">
                                                                <span class="input-group-addon"></span>
                                                            </div>
                                                            <i class='bx bxs-calendar'></i>
                                                        </div>
                                                    </div>
            
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Check Out</label>
                                                            <div class="input-group">
                                                                <input id="datetimepicker-check" type="text" name="checkout" class="form-control" placeholder="" value="<?php echo $_SESSION['checkout'];?>">
                                                                <span class="input-group-addon"></span>
                                                            </div>
                                                            <i class='bx bxs-calendar'></i>
                                                        </div>
                                                    </div>
            
                                                    <!-- <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Numbers of Persons</label>
                                                            <select name="person" class="form-control">
                                                                <option>01</option>
                                                                <option>02</option>
                                                                <option>03</option>
                                                                <option>04</option>
                                                                <option>05</option>
                                                            </select>	
                                                        </div>
                                                    </div>-->
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Numbers of Rooms</label>
                                                            <select name="rooms" class="form-control">
                                                                <?php
                                                                for($r=1;$r<=15;$r++)
                                                                {
                                                                ?>
                                                                <option <?php if($_SESSION['rooms']==$r){?>selected<?php }?> value="<?php echo $r;?>"><?php echo $r;?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>	
                                                        </div>
                                                    </div>
                        
                                                    <div class="col-lg-3 col-md-12">
                                                        <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                                        Check Rooms Availibility
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <?php
                                    if(!empty($checkin))
                                    {
                                    ?>
                                    <div class="col-lg-12">
                                        <div class="reservation-widget-content">
                                            <h2 style="margin-bottom: 10px;">Most Suitable Relevant Rooms</h2>
                                            <style>
                                                .search-query{clear: both;width:100%}
                                                .search-query ul{display: table;padding: 0px;}
                                                .search-query ul li{float: left; list-style-type: none;}
                                            </style>
                                            <div class="search-query">
                                                <ul>
                                                    <li>
                                                        <a href="index.html">BOOKING QUERY</a>
                                                    </li>
                                                    <li><i class="bx bx-chevron-right"></i></li>
                                                    <li>Checkin <span style="color:green; font-weight:bold">[<?php echo $_SESSION['checkin'];?>]</span></li>
                                                    <li><i class="bx bx-chevron-right"></i></li>
                                                    <li>Checkout <span style="color:green; font-weight:bold">[<?php echo $_SESSION['checkout'];?>]</span></li>
                                                    <li><i class="bx bx-chevron-right"></i></li>
                                                    <li>Rooms <span style="color:red; font-weight:bold"><?php echo $_SESSION['rooms'];?></span></li>
                                                </ul>
                                            </div>
                                            <div>&nbsp;</div>
                                            <div class="row">
                                            <?php      
                                            $i=1;
                                            

                                            $flag = 0;
                                            $sql = "select * from `room_category`";
                                            $type = 'r';
                                            if($type)
                                            {
                                                if($flag == 0)
                                                {
                                                    $sql .= " where `type` = '$type'";
                                                    $flag = 1;
                                                }
                                                else
                                                {
                                                    $sql .= " and `type` = '$type'";
                                                }
                                            }
                                            //echo $sql;
                                            $fetchData_rec = mysqli_query($mysqli,$sql." order by `id` desc");
                                            //$fetchCount = mysqli_num_rows(mysqli_query($mysqli,$sql));                                   
                                            while($fetchData_Res = mysqli_fetch_assoc($fetchData_rec))                                
                                            {
                                                
                                            ?>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="room-item reservation-room">
                                                        <div class="room-details-slider owl-carousel owl-theme">
                                                            <?php
                                                            $roomImages = mysqli_query($mysqli,"select * from `room_images` where `room_id`='".$fetchData_Res['id']."' order by `id` desc limit 0, 3");
                                                            while($roomImagesRes = mysqli_fetch_assoc($roomImages))
                                                            {
                                                            ?>
                                                            <div class="room-details-item" style="margin-bottom:0px !important">
                                                                <img src="<?php echo $sitelink;?>/assets/roomimages/<?php echo $roomImagesRes['images'];?>" alt="Images">
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="content">
                                                        
                                                            <h3><a href="room-details.html"><?php echo strtoupper($fetchData_Res['title']);?></a></h3>
                                                            <div style="display: table;margin-bottom: 10px;"><img style="width:105px;float: left;margin-right: 10px;border-radius: 5px;" src="<?php echo $sitelink;?>/assets/roomimages/<?php echo $fetchData_Res['images'];?>" alt="Images">You can easily reserve a hotel room with a double bed as you want. This will give you a very good feeling.</div>
                                                            <ul>
                                                                <li style="color:green">Room Available</li>
                                                                <li style="color:black"><?php 
                                              $roomAvailibilityCheck = roomAvailibilityCheck($mysqli,$fetchData_Res['id'],$_SESSION['checkin'],$_SESSION['checkout']);
                                              echo $fetchData_Res['no_room']-$roomAvailibilityCheck;
                                              ?></li>
                                                            </ul>
                                                            <ul>
                                                                <li class="text-color"><i class="fa fa-inr"></i><?php echo strtoupper($fetchData_Res['price']);?></li>
                                                                <li><span>Per Night</span></li>
                                                            </ul>
                                                            <a href="book.html" class="book-btn">VIEW DETAILS</a>
                                                        </div>
                                                        <?php
                                                        if(!isset($_SESSION['cid']))
                                                        {
                                                        ?>
                                                        <a data-toggle="modal" data-target="#modelPanel" href="<?php echo $sitelink;?>/widgets/sign_inWidget.php" class="default-btn btn-bg-one border-radius-5">BOOK NOW: <?php echo $rooms;?> ROOMS</a>
                                                        <?php
                                                        }else{
                                                        ?>
                                                        <a href="<?php echo $sitelink;?>/checkout/<?php echo $fetchData_Res['id'];?>" class="default-btn btn-bg-one border-radius-5">BOOK NOW: <?php echo $rooms;?> ROOMS</a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php
                                                $i++;
                                                }
                                                ?>

                                               
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Reservation widget Area End -->

        <!-- Book Area Two-->
        


        <?php include "include/footer.php";?>
        
    </body>
</html>