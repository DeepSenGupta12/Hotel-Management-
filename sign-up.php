<?php
session_start();
include "admin/include/config.php";
include "admin/include/function.php";
include "include/siteRequest.php";
if(isset($_SESSION['cid'])) 
{
    echo "<script>location.replace('".$sitelink."/reservation')</script>";    
}
if (empty($_SESSION['csrf_token'])) 
{
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!doctype html>
<html lang="zxx">
<?php include "include/headertop.php";?>
    <body>

    <?php include "include/header.php";?>

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg10">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="<?php echo $sitelink;?>">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>Sign Up</li>
                    </ul>
                    <h3>Sign Up</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Sign Up Area -->
        <div class="sign-up-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-all-form">
                            <div class="contact-form">
                                <div class="section-title text-center">
                                    <span class="sp-color">Sign Up</span>
                                    <h2>Create an Account!</h2>
                                </div>
                                <form method="post">
                                <?php echo alertNotification($_SESSION['msg']);?>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Fullname <span class="required">*</span></label>
											<input type="text" required name="fullname" value="<?php echo $customerDetails['fullname'];?>" class="form-control">
										</div>
									</div>


									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Company Name</label>
											<input type="text" required name="company" class="form-control" value="<?php echo $customerDetails['company'];?>">
										</div>
									</div>
                                    <div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Email Address <span class="required">*</span></label>
											<input type="email" required name="email" class="form-control">
										</div>
									</div>

									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Phone <span class="required">*</span></label>
											<input type="text" required name="mobile" class="form-control">
										</div>
									</div>
                                    <div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Password <span class="required">*</span></label>
											<input type="password" required name="password" class="form-control">
										</div>
									</div>
                                    <div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Retype Password <span class="required">*</span></label>
											<input type="password" required name="repassword" class="form-control">
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Country <span class="required">*</span></label>
											<div class="select-box">
												<select required class="form-control" name="country">
                                                    <option value="">Select One</option>
                                                    <?php
                                                    $country = mysqli_query($mysqli,"select * from `countries`");
                                                    while($countryRes = mysqli_fetch_assoc($country))
                                                    {
                                                    ?>
													<option value="<?php echo ucwords($countryRes['name']);?>"><?php echo ucwords($countryRes['name']);?></option>
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
												<select required class="form-control" name="state">
                                                    <option value="">Select One</option>
                                                    <?php
                                                    $state = mysqli_query($mysqli,"select * from `states` where `country_id`='101'");
                                                    while($stateRes = mysqli_fetch_assoc($state))
                                                    {
                                                    ?>
													<option value="<?php echo ucwords($stateRes['name']);?>"><?php echo ucwords($stateRes['name']);?></option>
                                                    <?php
                                                    }
                                                    ?>
													
												</select>
											</div>
										</div>
									</div>

									

									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<label>Address <span class="required">*</span></label>
											<input type="text" required class="form-control" name="address" value="<?php echo $customerDetails['address'];?>">
										</div>
									</div>

									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Town / City <span class="required">*</span></label>
											<input type="text" required class="form-control" name="city" value="<?php echo $customerDetails['city'];?>">
										</div>
									</div>

									

									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Postcode / Zip <span class="required">*</span></label>
											<input type="text" required class="form-control" name="pincode" value="<?php echo $customerDetails['pincode'];?>">
										</div>
									</div>
                                    <div class="col-lg-12 col-md-12 text-center">
                                    <input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
                                            <button type="submit" name="Submit" value="SignUp" class="default-btn btn-bg-three border-radius-5">
                                                Sign Up
                                            </button>
                                        </div>

                                        <div class="col-12">
                                            <p class="account-desc">
                                                Already have an account? 
                                                <a href="<?php echo $sitelink;?>/sign-in">Sign In</a>
                                            </p>
                                        </div>
									

									<!-- <div class="col-lg-12 col-md-12">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="create-an-account">
											<label class="form-check-label" for="create-an-account">Create an account?</label>
										</div>
									</div> -->
								</div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Sign Up Area End -->

        <?php include "include/footer.php";?>
        
    </body>
</html>