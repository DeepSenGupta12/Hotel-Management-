<?php
session_start();
include "admin/include/config.php";
include "admin/include/function.php";
?>
<!doctype html>
<html lang="zxx">
    <?php include "include/headertop.php";?>
    <body>

        <?php include "include/header.php";?>

        <!-- Banner Area -->
        <div class="banner-area">
            <div class="container">
                <div class="banner-content">
                    <h1>Book a Suitable Room and Visit Nearest Places With Us </h1>
                    <p>
                        Indrapuri hotel and resort is one of the best and loyal hotel in Siliguri.
                        We are helps to book you a good room with reasonable price.
                    </p>
                    <div class="banner-btn">
                        <a href="#" class="default-btn btn-bg-one border-radius-5">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Area End -->

        <!-- Banner Form Area -->
        <div class="banner-form-area">
            <div class="container">
                <div class="banner-form">
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
        </div>
        <!-- Banner Form Area End -->

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
                                <h4>We have 38 rooms 4 categories of room(Suite Roomm, Executive Room, DLX room, Standard Room). And We Have a Lots of Reasons Into The Choose Us From Other</h4>
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

        <!-- Services Area -->
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
                        <!-- <p>You can easily reserve a hotel room in a suitable place as you want. This will be able to make good feelings.</p>
                        <a href="service-details.html" class="get-btn">Get Service</a> -->
                        </div>
                        

                    </div>
                    <?php
                    }
                    ?>

                    



                </div>
            </div>
        </div>
        <!-- Services Area End -->

        <!-- Reservation Area -->
        <div class="reservation-area section-bg pt-100 pb-70">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="reservation-content">
                            <div class="section-title">
                                <h2> <a href="#">You Easily Reserve Our <b>AC BANQUET HALL : 100 PERSON FACILITY</b></a></h2><br />
                                <p>
                                    We have 100 person capacity of ac banquet hall. This will help you to make your programme beautiful. So, let's booking!
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
        <!-- Reservation Area End -->

        <!-- Specialty Area End -->
        <div class="specialty-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <span>SPECIALTY</span>
                    <h2>Our Specialization Sectors & All of the Other Details</h2>
                </div>

                <div class="row pt-45 align-items-center">
                    

                    <div class="col-lg-12 col-xxl-5">
                        <div class="specialty-list">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="specialty-list-card">
                                        <i class="flaticon-decoration"></i>
                                        <h3>Well Decoration</h3>
                                        <p>We are very careful about our room and food all of the hotel decorations. So, try us.</p>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="specialty-list-card">
                                        <i class="flaticon-tea-cup-with-muffin-and-cookies"></i>
                                        <h3>Delicious Food</h3>
                                        <p>You can easily order any kind of food from your room just a single call.</p>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="specialty-list-card">
                                        <i class="flaticon-fireworks"></i>
                                        <h3>3 Stars Rettings</h3>
                                        <p>Atoli is a Well Known Agency and the Agency is One of the Best by 5 Star Retting. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Specialty Area End -->

        <!-- Room Area -->
        <div class="room-area pt-100 pb-70 section-bg">
            <div class="container">
                <div class="section-title text-center">
                    <span>ROOMS</span>
                    <h2>Our Rooms & Rates</h2>
                </div>
                <div class="row pt-45">

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

        <!-- Testimonials Area -->
        <div class="testimonials-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <span>TESTIMONIALS</span>
                    <h2>Our Latest Testimonials and What Our Client Says</h2>
                </div>
                <div class="testimonials-slider owl-carousel owl-theme pt-45">
                    <div class="testimonials-item">
                        <i class="flaticon-left-quote"></i>
                        <p>
                            You can easily make a good and easily the best service from this agency. This is one 
                            of the best and crucial service for us. 
                        </p>
                        <ul>
                            <li>
                                <img src="assets/img/testimonials/testimonials-img1.jpg" alt="Images">
                                <h3>Pradip Kundu</h3>
                                <span>Jalpaiguri, West Bengal</span>
                            </li>
                        </ul>
                    </div>

                    <div class="testimonials-item">
                        <i class="flaticon-left-quote"></i>
                        <p>
                            You can easily make a good and easily the best service from this agency. This is one 
                            of the best and crucial service for us. 
                        </p>
                        <ul>
                            <li>
                                <img src="assets/img/testimonials/testimonials-img2.jpg" alt="Images">
                                <h3>Kartik Mahato</h3>
                                <span>Mumbai, Maharastra</span>
                            </li>
                        </ul>
                    </div>

                    <div class="testimonials-item">
                        <i class="flaticon-left-quote"></i>
                        <p>
                            You can easily make a good and easily the best service from this agency. This is one 
                            of the best and crucial service for us. 
                        </p>
                        <ul>
                            <li>
                                <img src="assets/img/testimonials/testimonials-img3.jpg" alt="Images">
                                <h3>Puja Sharma</h3>
                                <span>New Delhi, Delhi</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonials Area End -->

        <!-- FAQ Area -->
        <!-- <div class="faq-area pt-100 pb-70 section-bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-xxl-7">
                        <div class="faq-img">
                            <img src="assets/img/faq/faq-img1.jpg" alt="Images">
                        </div>
                    </div>

                    <div class="col-lg-6 col-xxl-5">
                        <div class="faq-content">
                            <div class="section-title">
                                <h2>Let's Start a Free of Questions And Get a Quick Support That Will Help You to Know Us</h2>
                            </div>

                            <div class="faq-accordion">
                                <ul class="accordion">
                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-plus'></i>
                                            How I Will Book a Room or Resort?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p> 
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo. Mauris a ante placerat,
                                                dignissim orci eget, viverra ante. Mauris ornare pellentesque augue. Curabitur leo nibh, ultrices 
                                                vel ultricies eu, vulputate at felis.
                                            </p>
                                        </div>
                                    </li>
    
                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-plus'></i>
                                            How I Will Be Able to Add on the Admin Portal? 
                                        </a>
        
                                        <div class="accordion-content">
                                            <p> 
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo. Mauris a ante placerat,
                                                dignissim orci eget, viverra ante. Mauris ornare pellentesque augue. Curabitur leo nibh, ultrices 
                                                vel ultricies eu, vulputate at felis.
                                            </p>
                                        </div>
                                    </li>
    
                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-plus'></i>
                                            What are the Benefits of These Agencies?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p> 
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo. Mauris a ante placerat,
                                                dignissim orci eget, viverra ante. Mauris ornare pellentesque augue. Curabitur leo nibh, ultrices 
                                                vel ultricies eu, vulputate at felis.
                                            </p>
                                        </div>
                                    </li>
    
                                    <li class="accordion-item">
                                        <a class="accordion-title active" href="javascript:void(0)">
                                            <i class='bx bx-plus'></i>
                                            How I Will Make Payment for Room Book?
                                        </a>
        
                                        <div class="accordion-content show">
                                            <p> 
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo. Mauris a ante placerat,
                                                dignissim orci eget, viverra ante. Mauris ornare pellentesque augue. Curabitur leo nibh, ultrices 
                                                vel ultricies eu, vulputate at felis.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- FAQ Area End -->

        <!-- Team Area -->
        <!-- <div class="team-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <span>TEAM</span>
                    <h2>Let's Meet Up With Our Special Team Members</h2>
                </div>
                <div class="team-slider owl-carousel owl-theme pt-45">
                    <div class="team-item">
                        <a href="team.html">
                            <img src="assets/img/team/team-img1.jpg" alt="Images">
                        </a>
                        <div class="content">
                            <h3><a href="team.html">Tom Shumate</a></h3>
                            <span>Manager</span>
                            <ul class="social-link">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                                </li> 
                            </ul>
                        </div>
                    </div>

                    <div class="team-item">
                        <a href="team.html">
                            <img src="assets/img/team/team-img2.jpg" alt="Images">
                        </a>
                        <div class="content">
                            <h3><a href="team.html">Carrie Horton</a></h3>
                            <span>Chief Reception Officer</span>
                            <ul class="social-link">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                                </li> 
                            </ul>
                        </div>
                    </div>

                    <div class="team-item">
                        <a href="team.html">
                            <img src="assets/img/team/team-img3.jpg" alt="Images">
                        </a>
                        <div class="content">
                            <h3><a href="team.html">Brian Orlando</a></h3>
                            <span>Housekeeping</span>
                            <ul class="social-link">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                                </li> 
                            </ul>
                        </div>
                    </div>

                    <div class="team-item">
                        <a href="team.html">
                            <img src="assets/img/team/team-img4.jpg" alt="Images">
                        </a>
                        <div class="content">
                            <h3><a href="team.html">Michael Evens</a></h3>
                            <span>Housekeeping</span>
                            <ul class="social-link">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                                </li> 
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Team Area End -->

        <!-- Blog Area -->
        <!-- <div class="blog-area pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <span>BLOGS</span>
                    <h2>Our Latest Blogs to the Intranational Journal at a Glance</h2>
                </div>
                <div class="row pt-45">
                    <div class="col-lg-6">
                        <div class="blog-card">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-4 p-0">
                                    <div class="blog-img">
                                        <a href="blog-details.html">
                                            <img src="assets/img/blog/blog-img1.jpg" alt="Images">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-7 col-md-8 p-0">
                                     <div class="blog-content">
                                         <span>October 08, 2020</span>
                                         <h3>
                                             <a href="blog-details.html">Hotel Management is the Best Policy</a>
                                         </h3>
                                         <p>This is one of the best & quality full hotels in the world that will help you to make a good market.</p>
                                         <a href="blog-details.html" class="read-btn">
                                             Read More
                                         </a>
                                     </div>
                                 </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="blog-card">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-4 p-0">
                                    <div class="blog-img">
                                        <a href="blog-details.html">
                                            <img src="assets/img/blog/blog-img2.jpg" alt="Images">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-7 col-md-8 p-0">
                                     <div class="blog-content">
                                         <span>October 11, 2020</span>
                                         <h3>
                                             <a href="blog-details.html">3d Hotel Models Have a Royal Model</a>
                                         </h3>
                                         <p>Hotel has made a revolutionary into the global market by making a 3D model on the hotel.</p>
                                         <a href="blog-details.html" class="read-btn">
                                             Read More
                                         </a>
                                     </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Blog Area End -->

        <?php include "include/footer.php";?>
        
    </body>
</html>