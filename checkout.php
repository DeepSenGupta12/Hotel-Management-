<?php
session_start();
$porps = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
$id = $porps[2];

$rooms = $_SESSION['rooms'];
$checkin = $_SESSION['checkin'];
$checkout = $_SESSION['checkout'];
include "admin/include/config.php";
include "admin/include/function.php";
include "include/siteRequest.php";


if(!isset($_SESSION['cid']))
{
    header('Location:'.$sitelink.'/sign-in');
}
if(isset($id))
{
    $_SESSION['roomid'] = $id;
    $fetchData_Res = roomDetails($mysqli,$_SESSION['roomid']);
    $customerDetails = customerDetails($mysqli,$_SESSION['cid']);
}
else
{
    header('Location:'.$sitelink.'/reservation');
}
if(empty($_SESSION['csrf_token'])) 
{
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
if(isset($_POST['Submit']))
{
    if($_POST['Submit'] == "Checkout")
    {
        
        $csrf_token = make_safe($mysqli,$_POST['csrf_token']);
        if($csrf_token == $_SESSION['csrf_token'])
        {
            $booking_id = substr(time(),2);
            $room_id = $fetchData_Res['id'];
            $price = make_safe($mysqli,$_POST['price']);
            $cname = make_safe($mysqli,$_POST['cname']);
            $cmobile = make_safe($mysqli,$_POST['cmobile']);
            $cemail = make_safe($mysqli,$_POST['cemail']);
            $company = make_safe($mysqli,$_POST['company']);
            $country = make_safe($mysqli,$_POST['country']);
            $state = make_safe($mysqli,$_POST['state']);
            $address = make_safe($mysqli,$_POST['address']);
            $city = make_safe($mysqli,$_POST['city']);
            $pincode = make_safe($mysqli,$_POST['pincode']);
            $paytype = make_safe($mysqli,$_POST['paytype']);
            $sql = "insert into `room_booking`(`cid`,`cname`,`cmobile`,`cemail`,`company`,`booking_id`,`room_id`,`no_room`,`checkin`,`checkout`,`price`,`paytype`) values('".$_SESSION['cid']."','".$cname."','".$cmobile."','".$cemail."','".$company."','".$booking_id."','".$room_id."','".$rooms."','".$checkin."','".$checkout."','".$price."','".$paytype."')";
            $insertBooking = mysqli_query($mysqli,$sql);
            header('Location:'.$sitelink.'/confirm/'.$booking_id);
        }
    }
}
?>
<!doctype html>
<html lang="zxx">
<?php include "include/headertop.php";?>
    <body>

        <?php include "include/header.php";?>

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg3">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li> Check Out</li>
                    </ul>
                    <h3> Check Out</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Checkout Area -->
		<section class="checkout-area pt-100 pb-70">
			<div class="container">
				<form method="post">
					<div class="row">
                        
						<div class="col-lg-12 col-md-12">
							<div class="billing-details">
                            <div class="col-lg-12 col-md-12">
                                <div class="room-item booking_cont">
                                    
                                    <div class="book_content">
                                    
                                        <h3><a href="room-details.html" style="color:#292323">ROOM BOOKING</a></h3>
                                        
                                            <table class="table table-bordered table-hover">
                                                <tr>
                                                    <th>Room</th>
                                                    <th>Check In</th>
                                                    <th>Check Out</th>
                                                    <th width="30%">Number of rooms</th>                                                    
                                                </tr>
                                                <tr>
                                                    <td><?php echo strtoupper($fetchData_Res['title']);?></td>
                                                    <td><?php echo $checkin;?></td>
                                                    <td><?php echo $checkout;?></td>
                                                    <td><?php echo $rooms;?></td>                                                    
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="right">Room Price</td>
                                                    <td><i class="fa fa-inr text-color"></i> <?php echo $fetchData_Res['price'];?> /-</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="right">Total Price</td>
                                                    <td>
                                                      <span style="color:#222; font-size:12px"><?php echo $fetchData_Res['price']."x".$rooms;?></span><br />
                                                      <i class="fa fa-inr text-color"></i> <?php $totalPrice = round($fetchData_Res['price']*$rooms);echo $totalPrice;?> /-
                                                    
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="right">GST(<?php echo $siteSettings['gst'];?>%)</td>
                                                    <td>
                                                      
                                                      <i class="fa fa-inr text-color"></i> <?php $grandTotal= round($totalPrice+$totalPrice/100*$siteSettings['gst']);echo $grandTotal;?> /-
                                                    <input type="hidden" name="price" value="<?php echo $grandTotal;?>" />
                                                    </td>
                                                </tr>
                                            </table>
                                        
                                        
                                        
                                        <a href="<?php echo $sitelink;?>/reservation" class="">CHOOSE OTHERS ROOM</a>
                                    </div>
                                    
                                    <a href="<?php echo $sitelink;?>/checkout/<?php echo $fetchData_Res['id'];?>" class="default-btn btn-bg-one border-radius-5">CHOOSE OTHERS ROOM</a>
                                    
                                </div>
                            </div>
								<h3 class="title">BOOKING DETAILS</h3>

								<div class="row">
                                    <div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Fullname <span class="required">*</span></label>
											<input type="text" name="cname" value="<?php echo $customerDetails['fullname'];?>" class="form-control">
										</div>
									</div>


									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Company Name</label>
											<input type="text" name="company" class="form-control" value="<?php echo $customerDetails['company'];?>">
										</div>
									</div>
                                    <div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Email Address <span class="required">*</span></label>
											<input type="cemail" name="cemail" class="form-control" value="<?php echo $customerDetails['email'];?>">
										</div>
									</div>

									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Phone <span class="required">*</span></label>
											<input type="text" name="cmobile" class="form-control" value="<?php echo $customerDetails['mobile'];?>">
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Country <span class="required">*</span></label>
											<div class="select-box">
												<select class="form-control" name="country">
                                                    <option value="">Select One</option>
                                                    <?php
                                                    $country = mysqli_query($mysqli,"select * from `countries`");
                                                    while($countryRes = mysqli_fetch_assoc($country))
                                                    {
                                                    ?>
													<option <?php if($customerDetails['country'] == $countryRes['name']){?>selected<?php }?> value="<?php echo ucwords($countryRes['name']);?>"><?php echo ucwords($countryRes['name']);?></option>
                                                    <?php
                                                    }
                                                    ?>
													
												</select>
											</div>
										</div>
									</div>
                                    <div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>State <span class="required">*</span></label>
											<div class="select-box">
												<select class="form-control" name="state">
                                                    <option value="">Select One</option>
                                                    <?php
                                                    $state = mysqli_query($mysqli,"select * from `states` where `country_id`='101'");
                                                    while($stateRes = mysqli_fetch_assoc($state))
                                                    {
                                                    ?>
													<option <?php if($customerDetails['state'] == $stateRes['name']){?>selected<?php }?> value="<?php echo ucwords($stateRes['name']);?>"><?php echo ucwords($stateRes['name']);?></option>
                                                    <?php
                                                    }
                                                    ?>
													
												</select>
											</div>
										</div>
									</div>

									

									<div class="col-lg-4 col-md-12">
										<div class="form-group">
											<label>Address <span class="required">*</span></label>
											<input type="text" class="form-control" name="address" value="<?php echo $customerDetails['address'];?>">
										</div>
									</div>

									<div class="col-lg-4 col-md-12">
										<div class="form-group">
											<label>Town / City <span class="required">*</span></label>
											<input type="text" class="form-control" name="city" value="<?php echo $customerDetails['city'];?>">
										</div>
									</div>

									

									<div class="col-lg-4 col-md-12">
										<div class="form-group">
											<label>Postcode / Zip <span class="required">*</span></label>
											<input type="text" class="form-control" name="pincode" value="<?php echo $customerDetails['pincode'];?>">
										</div>
									</div>

									

									<!-- <div class="col-lg-12 col-md-12">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="create-an-account">
											<label class="form-check-label" for="create-an-account">Create an account?</label>
										</div>
									</div> -->
								</div>
							</div>
						</div>

						<div class="col-lg-12 col-md-12">
							<div class="payment-box">
                                <div class="payment-method">
                                    
                                    <p>
                                        <input type="radio" id="paypal" name="paytype" value="online">
                                        <label for="paypal">Online Payment</label>
                                    </p>
                                    <p>
                                        <input type="radio" id="cash-on-delivery" name="paytype" value="offline">
                                        <label for="cash-on-delivery">Cash On Delivery</label>
                                    </p>
                                </div>
                                <input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
                                <button name="Submit" value="Checkout" type="submit" class="order-btn three">
                                    Place to Order
                                </button>
                            </div>
						</div>
					</div>
				</form>
			</div>
		</section>
		<!-- Checkout Area End -->

        <?php include "include/footer.php";?>
        
    </body>
</html>