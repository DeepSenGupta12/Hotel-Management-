<?php
include "admin/include/config.php";
include "admin/include/function.php";
?>
<!doctype html>
<html lang="zxx">
   <?php include "include/headertop.php";?>
    <body>

        <?php include "include/header.php";?>

        
        <!-- Inner Banner -->
        <div class="inner-banner inner-bg2">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="index">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>Contact</li>
                    </ul>
                    <h3>Contact</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Contact Area -->
        <div class="contact-area pt-100 pb-70">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="contact-content">
                            <div class="section-title">
                                <h2>Let's Start to Give Us a Message and Contact With Us</h2>
                            </div>
                            <div class="contact-img">
                                <img src="<?php echo $sitelink;?>/assets/images/contact.jpg" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="contact-form">
                            <form id="contactForm">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Name">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Email">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="phone_number" id="phone_number" required data-error="Please enter your number" class="form-control" placeholder="Phone">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="Please enter your subject" placeholder="Your Subject">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control" id="message" cols="30" rows="8" required data-error="Write your message" placeholder="Your Message"></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group checkbox-option">
                                            <input type="checkbox" id="chb2">
                                            <p>
                                                Accept <a href="terms-condition.html">Terms & Conditions</a> And <a href="privacy-policy.html">Privacy Policy.</a>
                                            </p>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn btn-bg-three">
                                            Send Message
                                        </button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Area End -->

        <!-- contact Another -->
        <div class="contact-another pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="contact-another-content">
                            <div class="section-title">
                                <h2>Contacts Info</h2>
                                <p>
                                    We are one of the best hotel and we can easily make a contract
                                    us anytime on the below details.
                                </p>
                            </div>

                            <div class="contact-item">
                                <ul>
                                    <li>
                                        <i class='bx bx-home-alt'></i>
                                        <div class="content">
                                            <span>NH-31, Mallguri, Siligur-734003(W.B.)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <i class='bx bx-phone-call'></i>
                                        <div class="content">
                                            <span><a href="#">(0353) 3500576 / 3500558</a></span>
                                        </div>
                                    </li>
                                    <li>
                                        <i class='bx bx-envelope'></i>
                                        <div class="content">
                                            <span><a href="bookindrapurihotel@gmail.com">bookindrapurihotel@gmail.com</a></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-5">
                        <div class="contact-another-img">
                            <img src="<?php echo $sitelink;?>/assets/images/hotel.jpg" alt="Images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact Another End -->

        <!-- Map Area -->
        <div class="map-area">
            <div class="container-fluid m-0 p-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3563.3651844440537!2d88.40981444992134!3d26.73272017417021!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e4412590adbf17%3A0x7b0319892fcc1eff!2sIndrapuri%20Hotel%20and%20Resort%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1672984805926!5m2!1sen!2sin" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <!-- Map Area End -->

        <!-- Footer Area -->
        <?php include "include/footer.php";?>
        
    </body>
</html>