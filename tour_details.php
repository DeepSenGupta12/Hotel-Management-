<?php
include "admin/include/config.php";
include "admin/include/function.php";
$client_name = strtok($_SERVER['HTTP_HOST'],".");
list($hotname,$id) = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
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
                        <li>Blog Details </li>
                    </ul>
                    <h3>Blog Details</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Blog Details Area -->
        <div class="blog-details-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-article">
                            <div class="blog-article-img">
                                <img src="assets/img/blog/blog-details-img1.jpg" alt="Images">
                            </div>

                            <div class="blog-article-title">
                                <h2>Hotel Management is the Best Issue in the Global Market</h2>
                                <ul>
                                    
                                    <li>
                                        <i class='bx bx-user'></i>
                                        By Mark Angular
                                    </li>

                                    <li>
                                        <i class='bx bx-calendar'></i>
                                        October 14, 2020
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="article-content">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore 
                                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore 
                                </p>
                                <p>
                                    Ecespiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, 
                                    eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim 
                                    ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui
                                    ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quci velit modi tempora incidunt
                                    ut labore et dolore magnam aliquam quaerat .
                                </p>

                                <blockquote class="blockquote"> 
                                    <p>
                                        Awesome dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        Ut enim ad minim veniam, quis nostrud exercitationaco laboris nisi ut aliquip commodo consequat. 
                                    </p>
                                </blockquote>
                            </div>

                            <div class="another-content">
                                <div class="content-img">
                                    <img src="assets/img/blog/blog-details-img2.jpg" alt="Images">
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu eros sed tellus fringilla molestie vitae quis mauris.
                                    Nunc fringilla nisi dui. Maecenas ornare et neque vel convallis. Pellentesque eu finibus augue. Proin quis gravida mauris.
                                    Donec ullamcorper varius egestas. Suspendisse ante massa, posuere a ipsum eu, lacinia tincidunt neque. Pellentesque habitant
                                    morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur laoreet in odio in placerat. 
                                </p>
                                <p>
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    Excabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni 
                                    dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, 
                                    consectetur, adipisci velit
                                </p>
                            </div>

                            <div class="comments-wrap">
								<h3 class="title">Comments</h3>
								<ul>
									<li>
										<img src="assets/img/blog/blog-profile1.jpg" alt="Image">
										<h3>Megan Fox</h3>
										<span>October 14, 2020, 12:10 PM</span>
										<p>
                                            Engineering requires many building blocks and tools. To produce real world 
                                            results & one must  mathematics and sciences to tangible problems and we 
                                            are one of the  best company in the world. 
                                        </p>
										<a href="#"> Reply</a>
                                    </li>
                                    
                                    <li>
										<img src="assets/img/blog/blog-profile2.jpg" alt="Image">
										<h3>Mike Thomas</h3>
										<span>October 14, 2020, 11:30 AM</span>
										<p>
                                            Engineering requires many building blocks and tools. To produce real world 
                                            results & one must  mathematics and sciences to tangible problems and we 
                                            are one of the  best company in the world. 
                                        </p>
										<a href="#"> Reply</a>
                                    </li>
								</ul>
                            </div>

                            <div class="comments-form">
                                <div class="contact-form">
                                    <h2>Leave A Comment</h2>
                                    <form id="contactForm">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Your Name">
                                                </div>
                                            </div>
            
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="form-group">
                                                    <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Your Email">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" name="websit" class="form-control" required data-error="Your website" placeholder="Your website">
                                                </div>
                                            </div>
            
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <textarea name="message" class="form-control" id="message" cols="30" rows="8" required data-error="Write your message" placeholder="Your Message"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group checkbox-option">
                                                    <input type="checkbox" id="chb2">
                                                    <p>
                                                        Save my name, email, and website in this browser for the next time I comment.
                                                    </p>
                                                </div>
                                            </div>
            
                                            <div class="col-lg-12 col-md-12">
                                                <button type="submit" class="default-btn btn-bg-three">
                                                    Post A Comment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="side-bar-wrap">
                            <div class="search-widget">
                                <form class="search-form">
                                    <input type="search" class="form-control" placeholder="Search...">
                                    <button type="submit">
                                        <i class="bx bx-search"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="side-bar-widget">
                                <h3 class="title">Recent Posts</h3>
                                <div class="widget-popular-post">
                                    <article class="item">
                                        <a href="blog-details.html" class="thumb">
                                            <span class="full-image cover bg1" role="img"></span>
                                        </a>
                                        <div class="info">
                                            <h4 class="title-text">
                                                <a href="blog-details.html">
                                                    Hotel Room Reservation is a Common Fact Now
                                                </a>
                                            </h4>
                                            <ul>
                                                <li>
                                                    <i class='bx bx-user'></i>
                                                    29K
                                                </li>
                                                <li>
                                                    <i class='bx bx-message-square-detail'></i>
                                                    15K
                                                </li>
                                            </ul>
                                        </div>
                                    </article>
    
                                    <article class="item">
                                        <a href="blog-details.html" class="thumb">
                                            <span class="full-image cover bg2" role="img"></span>
                                        </a>
                                        <div class="info">
                                            <h4 class="title-text">
                                                <a href="blog-details.html">
                                                    We Can Easily Make a Good Hotel Management
                                                </a>
                                            </h4>
                                            <ul>
                                                <li>
                                                    <i class='bx bx-user'></i>
                                                    49K
                                                </li>
                                                <li>
                                                    <i class='bx bx-message-square-detail'></i>
                                                    17K
                                                </li>
                                            </ul>
                                        </div>
                                    </article>
    
                                    <article class="item">
                                        <a href="news-details.html" class="thumb">
                                            <span class="full-image cover bg3" role="img"></span>
                                        </a>
                                        <div class="info">
                                            <h4 class="title-text">
                                                <a href="news-details.html">
                                                    Hotel Management Has Made a New Goal
                                                </a> 
                                            </h4>
                                            <ul>
                                                <li>
                                                    <i class='bx bx-user'></i>
                                                    69K
                                                </li>
                                                <li>
                                                    <i class='bx bx-message-square-detail'></i>
                                                    52K
                                                </li>
                                            </ul>
                                        </div>
                                    </article>
                                </div>
                            </div>

                            <div class="side-bar-widget">
                                <h3 class="title">Tags</h3>
                                <ul class="side-bar-widget-tag">
                                    <li><a href="#">Hotel</a></li>
                                    <li><a href="#">Booking</a></li>
                                    <li><a href="#">Luxury</a></li>
                                    <li><a href="#">Beach</a></li>
                                    <li><a href="#">Resorts</a></li>
                                    <li><a href="#">Room</a></li>
                                    <li><a href="#">Single</a></li>
                                    <li><a href="#">Family</a></li>
                                    <li><a href="#">Sea View</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog Details Area End -->

        <!-- Footer Area -->
        <?php include "include/footer.php";?>
        
    </body>
</html>