<?php
session_start();
include "admin/include/config.php";
include "admin/include/function.php";
include "include/siteRequest.php";

$props = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
$id = $props[2];

$bookingDetails = bookingDetails($mysqli,$id);
?>
<!doctype html>
<html lang="zxx">
<?php include "include/headertop.php";?>
    <body>

        <!-- PreLoader Start -->
        <div class="preloader">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="sk-cube-area">
                        <div class="sk-cube1 sk-cube"></div>
                        <div class="sk-cube2 sk-cube"></div>
                        <div class="sk-cube4 sk-cube"></div>
                        <div class="sk-cube3 sk-cube"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- PreLoader End -->

        <!-- Start Coming Soon Area -->
        <div class="coming-soon-area">
			<div class="d-table">
				<div class="d-table-cell">
					<div class="container">
						<div class="coming-soon-content">
							<h1>Booking Confirm</h1>
							<p>Your booking id</p>

							<div id="timer">
								<div id="days"><?php echo $bookingDetails['booking_id'];?></div>
								<!-- <div id="hours"></div>
								<div id="minutes"></div>
								<div id="seconds"></div> -->
							</div>
							
							<form class="newsletter-form" data-toggle="validator">
                                <a href="<?php echo $sitelink;?>" style="position:relative !important" class="default-btn btn-bg-three">
									HOME
                                </a>
                                
								<a type="submit" style="position:relative !important" class="default-btn btn-bg-one border-radius-5">
									DOWNLOAD
                                </a>
								<div id="validator-newsletter" class="form-result"></div>
							</form> 
<br /><br />
							<ul class="header-content-right">
								<li>
									<a href="#">
										<i class="bx bxl-facebook"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="bx bxl-twitter"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="bx bxl-pinterest-alt"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="bx bxl-instagram"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!-- End Coming Soon Area -->

        <?php include "include/footer.php";?>
        
    </body>
</html>