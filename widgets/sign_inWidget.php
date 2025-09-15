<?php
session_start();
?>
<div class="sign-in-area">
<button type="button" class="button_close default-btn btn-bg-three border-radius-5" data-dismiss="modal">&times;</button>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">              
                        <div class="user-all-form">
                            <div class="contact-form">
                                <div class="section-title text-center">
                                    <h2>Sign In to Your Account!</h2>
                                </div>
                                <form id="contactForm" method="post">
                                <?php //echo alertNotification($_SESSION['msg']);?>
                                    <div class="row">
                                        <div class="col-lg-12 ">
                                            <div class="form-group">
                                                <input type="text" name="mobile" id="name" class="form-control" required data-error="Please enter your 10 digit mobile number" placeholder="Mobile or Email">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <input class="form-control" type="password" name="password" placeholder="Password">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-sm-6 form-condition">
                                            <div class="agree-label">
                                                <input type="checkbox" id="chb1">
                                                <label for="chb1">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>
            
                                        <div class="col-lg-6 col-sm-6">
                                            <a class="forget" href="#">Forgot My Password?</a>
                                        </div>
        
                                        <div class="col-lg-12 col-md-12 text-center">
                                        <input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
                                            <button name="Submit" value="SignIn" type="submit" class="default-btn btn-bg-three border-radius-5">
                                                Sign In Now
                                            </button>
                                        </div>

                                        <div class="col-12">
                                            <p class="account-desc">
                                                Not a Member?
                                                <a href="sign-up">Sign Up</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>