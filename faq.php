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

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg3">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>FAQ</li>
                    </ul>
                    <h3>FAQ</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- FAQ Area -->
        <div class="faq-area pt-100 pb-70 section-bg-2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="faq-content faq-content-bg2">
                            <div class="section-title">
                                <span class="sp-color">FREE OF QUESTION</span>
                                <h2>Let's Start a Free of Questions and Get a Quick Support</h2>
                                <p>We are the team of Indrapuri Hotel who always gives you a priority on the free of question and you can easily make a question on the bunch.</p>
                            </div>

                            <div class="faq-accordion">
                                <ul class="accordion">
                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-plus'></i>
                                            How I Will Book a Room?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p> 
                                            Here are several tips to help you book room.
                                            </p>
                                            <ul>
                                                <li>1. Go to the booking option</li>
                                                <li>2. Find rooms as per your requirments with check in check out date</li>
                                                <li>3. Register your profile with us</li>
                                                <li>4. Specify way of payment - either online or in the hotel upon arrival</li>
                                            </ul>
                                        </div>
                                    </li>
    
                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-plus'></i>
                                            How you reach our hotel? 
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>Near By Destination</p>
                                            <ul>
                                                <li>1. Bagdogra Airport         : 15km</li>
                                                <li>2. New Jalpaiguri Rly       : 8km</li>
                                                <li>3. Siliguri Junction        : 1km</li>
                                                <li>4. Bus Terminal             : 1km</li>

                                            </ul><br />
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3563.3651844440537!2d88.40981444992134!3d26.73272017417021!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e4412590adbf17%3A0x7b0319892fcc1eff!2sIndrapuri%20Hotel%20and%20Resort%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1672984805926!5m2!1sen!2sin" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                    </li>
    
                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-plus'></i>
                                            What are the Benefits of Our Hotel?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p> 
                                                List of facilities of our hotel
                                            </p>
                                            <ul>
                                                <li>1. Reasonable hotel prices</li>
                                                <li>2. Good Hospitality</li>
                                                <li>3. Nearest Tourist Place</li>
                                                <li>4. Transport Facility</li>
                                                
                                            </ul>
                                        </div>
                                    </li>
    
                                    <li class="accordion-item">
                                        <a class="accordion-title active" href="javascript:void(0)">
                                            <i class='bx bx-plus'></i>
                                            How I Will Make Payment for Room Book?
                                        </a>
        
                                        <div class="accordion-content show">
                                            <p> 
                                                After choose your room as per your requirments you can pay online or arrival time.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="faq-img-3">
                            <img src="<?php echo $sitelink;?>/assets/images/faq.jpg" alt="Images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQ Area End -->

        <!-- FAQ Another -->
        <!-- <div class="faq-another pt-100 pb-70">
            <div class="container">
                <div class="faq-form">
                    <div class="contact-form">
                        <div class="section-title text-center">
                            <h2>Ask Questions</h2>
                        </div>
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
        </div> -->
        <!-- FAQ Another End -->

        <!-- Footer Area -->
        <?php include "include/footer.php";?>
        
    </body>
</html>