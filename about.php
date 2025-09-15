<?php
session_start();
include "admin/include/config.php";
include "admin/include/function.php";
?>
<!doctype html>
<html lang="zxx">
<?php include "include/headertop.php";?>
    <body>

        <!-- PreLoader Start -->
        <?php include "include/header.php";?>
        <div class="inner-banner inner-bg10">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="<?php echo $sitelink;?>/index">Home</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>About Us </li>
                    </ul>
                    <h3>About our hotel</h3>
                </div>
            </div>
        </div>

        <!-- About Area -->
        <div class="about-area pt-100 pb-70">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-img">
                            <img src="assets/images/hotel.jpg" alt="Images">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="about-content">
                            <div class="section-title">
                                <span>About Us</span>
                                <h4>We have 40 rooms 4 categories of room(Suite Roomm, Executive Room, DLX room, Standard Room). And We Have a Lots of Reasons Into The Choose Us From Other</h4>
                                <!-- <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tristique augue quis neque ornare fermentum.
                                    In sit amet mattis diam. Sed id aliquam nulla. In porttitor et turpis non pretium.
                                </p> -->
                            </div>

                            <ul>
                                <li>
                                    <i class="flaticon-restaurant"></i>
                                    <div class="content">
                                        <h3>AC Banquet Hall</h3>
                                        <p>
                                            We are provide you ac banquet hall in a restaurant,
                                            facilities for all of our guides and all of our guests.
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <i class="flaticon-wifi-signal-1"></i>
                                    <div class="content">
                                        <h3>Free Wifi Facilities</h3>
                                        <p>
                                            This is the place where you will get a free wifi zone on a reasonable price and this
                                            will help you to make a colourful happy moments.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                            <a href="#" class="default-btn btn-bg-one border-radius-5">Read More</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- About Area End -->

        <!-- Choose Area -->
        <div class="services-area pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <span>Our Services</span>
                    <h2>Our Services on the Global Market for Our Client's Reservation</h2>
                </div>
                <div class="services-slider owl-carousel owl-theme pt-45">
                    <?php
                    $facility = mysqli_query($mysqli,"select * from `room_facility` order by `id` desc");
                    while($facilityRes = mysqli_fetch_assoc($facility))
                    {
                    ?>
                    <div class="services-item">
                        <img style="border-radius: 10px;" src="<?php echo $sitelink;?>/assets/services/<?php echo $facilityRes['images'];?>" alt="">
                        <div style="padding:20px">
                        <h3><a href="service-details.html"><?php echo strtoupper($facilityRes['title']);?></a></h3>
                        <p>You can easily reserve a hotel room in a suitable place as you want. This will be able to make good feelings.</p>
                        <a href="service-details.html" class="get-btn">Get Service</a>
                        </div>
                        

                    </div>
                    <?php
                    }
                    ?>

                    



                </div>
            </div>
        </div>
        <!-- Choose Area End -->

        <!-- Ability Area -->
        <div class="reservation-area section-bg pt-100 pb-70">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="reservation-content">
                            <div class="section-title">
                                <h2> <a href="#">You Easily Reserve Our <b>AC BANQUET HALL : 100 PERSON FACILITY</b></a></h2><br />
                                <p>
                                    This is one of the important facility that helps us to make one of the booking hall. This will help you to make your programme beautiful. So, let's booking!
                                </p>
                            </div>
                            <a href="#" class="default-btn btn-bg-one border-radius-5">Quick Booking</a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="reservation-img">
                            <img src="<?php echo $sitelink;?>/assets/images/hall.jpeg" alt="Images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ability Area  End -->

        
        <!-- Specialty Area Two End -->

        
        <!-- Team Area Two End -->

        <!-- Testimonials Area Another -->
        <!-- Testimonials Area Another End -->

        <!-- Footer Area -->
        <?php include "include/footer.php";?>
        
    </body>
</html>