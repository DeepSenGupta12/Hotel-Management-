<?php
include "admin/include/config.php";
include "admin/include/function.php";
?>
<!doctype html>
<html lang="zxx">
<?php include "include/headertop.php";?>
    <body>

        <?php include "include/header.php";?>
        <div class="inner-banner inner-bg10">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>Room & Tariff </li>
                    </ul>
                    <h3>Room & Tariff</h3>
                </div>
            </div>
        </div>
        <!-- Room Area -->
        <div class="room-area ptb-70">
            <div class="container">
                <div class="section-title text-center">
                    <span class="sp-color">ROOMS</span>
                    <h2>Our Rooms & Rates</h2>
                </div>
                <div class="row pt-45">
                    <div class="col-lg-12">
                        <div class="side-bar-form">
                            <h3>Booking Query </h3>
                            <form method="get" action="reservation">
                        
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>CHECK IN TIME</label>
                                    <div class="input-group">
                                        <input id="datetimepicker" type="text" name="checkin" class="form-control checkin_date" value="<?php echo date("Y-m-d");?>">
                                    </div>
                                    <i class='bx bxs-chevron-down'></i>	
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>CHECK OUT TIME</label>
                                    <div class="input-group">
                                        <input id="datetimepicker-check" type="text" name="checkout" class="form-control" value="<?php echo date('Y-m-d', strtotime("+1 day"));?>">
                                    </div>
                                    <i class='bx bxs-chevron-down'></i>	
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>ROOMS</label>
                                    <select name="rooms" class="form-control">
                                    <?php
                                    for($r=1;$r<=15;$r++)
                                    {
                                    ?>
                                    <option value="<?php echo $r;?>"><?php echo $r;?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>	
                                </div>
                            </div>
                            <input type="hidden" name="type" value="r" />
                            <div class="col-lg-4 col-md-4">
                                <button type="submit" name="Search" value="RoomBooking" class="default-btn btn-bg-one border-radius-5">
                                Check Availibility
                                </button>
                            </div>
                        </div>
                    </form>
                        </div>
                    </div>
                <?php
                $rooms = mysqli_query($mysqli,"SELECT * FROM `room_category` where `type`='r'");
                while($roomsRes = mysqli_fetch_assoc($rooms))
                {
                ?>
                    <div class="col-lg-6 col-md-6">
                        <div class="room-card">
                            <a href="#">
                                <img src="<?php echo $sitelink;?>/assets/roomimages/<?php echo $roomsRes['images'];?>" alt="Images">
                            </a>
                            <div class="content">
                                <h3><a href="#"><?php echo strtoupper($roomsRes['title']);?></a></h3>
                                <ul>
                                    <li><h2><i class="fa fa-rupee"></i>&nbsp;<?php echo strtoupper($roomsRes['price']);?></h2></li>
                                    <li>Per Night</li>
                                </ul>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star-half'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                    ?>

                    
                </div>
            </div>
        </div>
        <!-- Room Area End -->

       <?php include "include/footer.php";?>


        
    </body>
</html>