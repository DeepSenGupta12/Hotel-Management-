<?php
$siteSettings = siteSettings($mysqli);
$customerDetails = customerDetails($mysqli,$_SESSION['cid']);
?>
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

        <!-- Top Header Start -->
        <header class="top-header top-header-bg">
            <div class="container">
                <div class="row align-items-left">
                <div class="col-lg-9 col-md-10">
                        <div class="header-right" style="text-align: left;">
                            <ul>
                                
                                <li>
                                    <i class='bx bx-phone-call'></i>
                                    <a href="#">(0353) <?php echo $siteSettings['contact'];?> / <?php echo $siteSettings['altcontact'];?></a>
                                </li>
                                <li>
                                    <i class='bx bx-envelope'></i>
                                    <a href="mailto:<?php echo $siteSettings['email'];?>"><?php echo $siteSettings['email'];?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-2 pr-0" style="text-align: right;">
                    <?php
                        if(isset($_SESSION['cid']))
                        {
                        ?>
                        <div class="dropdown">
                        <button class="default-btn btn-bg-three border-radius-5" style="padding: 2px 5px;" type="button" data-toggle="dropdown"><?php echo ucwords($customerDetails['fullname'])?>
                        </button>
                        
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $sitelink;?>/logout">Logout</a></li>
                            </ul>
                        
                        
                        </div>
                        <?php
                        }else{
                        ?> 
                        <div class="dropdown">
                        <button class="default-btn btn-bg-three border-radius-5" style="padding: 2px 5px;" type="button" data-toggle="dropdown">Hello, [GUEST]
                        </button>
                        
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $sitelink;?>/sign-up">Sign Up</a></li>
                                <li><a href="<?php echo $sitelink;?>/sign-in">Login</a></li>
                            </ul>
                        
                        
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    

                    
                </div>
            </div>
        </header>
        <!-- Top Header End -->

        <!-- Start Navbar Area -->
        <div class="navbar-area">
            <!-- Menu For Mobile Device -->
            <div class="mobile-nav">
                <a href="<?php echo $sitelink;?>/index" class="logo">
                    <img src="<?php echo $sitelink."/assets/logo/".$siteSettings['logo'];?>" class="logo-one" alt="Logo">
                    <img src="<?php echo $sitelink."/assets/logo/".$siteSettings['logo'];?>" class="logo-two" alt="Logo">
                </a>
            </div>

            <!-- Menu For Desktop Device -->
            <div class="main-nav">
                <div class="container">
                    <nav class="navbar navbar-expand-md navbar-light ">
                        <a class="navbar-brand" href="index">
                            <img src="<?php echo $sitelink."/assets/logo/".$siteSettings['logo'];?>" class="logo-one" alt="Logo">
                            <img src="<?php echo $sitelink."/assets/logo/".$siteSettings['logo'];?>" class="logo-two" alt="Logo">
                        </a>

                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item">
                                    <a href="<?php echo $sitelink;?>/index" class="nav-link active">
                                        HOME 
                                        
                                    </a>
                                    
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $sitelink;?>/rooms" class="nav-link">
                                        ROOMS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $sitelink;?>/menu" class="nav-link">
                                        MENU
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $sitelink;?>/gallery" class="nav-link">
                                        GALLERY
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $sitelink;?>/tour" class="nav-link">
                                        TOUR PLACES
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $sitelink;?>/faq" class="nav-link">
                                        FAQ
                                    </a>
                                </li>

                                
                                <li class="nav-item">
                                    <a href="<?php echo $sitelink;?>/about" class="nav-link">
                                        ABOUT
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo $sitelink;?>/contact" class="nav-link">
                                        CONTACT
                                    </a>
                                </li>

                                <li class="nav-item-btn">
                                    <a href="#" class="default-btn btn-bg-one border-radius-5">BOOK NOW</a>
                                </li>
                            </ul>

                            <div class="nav-btn">
                                <a href="#" class="default-btn btn-bg-one border-radius-5">BOOK NOW</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- End Navbar Area -->