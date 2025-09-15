<?php
include "admin/include/config.php";
include "admin/include/function.php";
?>
<!doctype html>
<html lang="zxx">
<?php include "include/headertop.php"; ?>

<body>

    <?php include "include/header.php"; ?>

    <!-- Inner Banner -->
    <div class="inner-banner inner-bg3">
        <div class="container">
            <div class="inner-title">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>Nearest Tour Places</li>
                </ul>
                <h3>Nearest Tour Places</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Blog Style Area -->
    <div class="blog-style-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php
                    $tour = mysqli_query($mysqli, "select * from `tour_place`");
                    while ($tourRes = mysqli_fetch_assoc($tour)) {
                        $tourImages = mysqli_fetch_assoc(mysqli_query($mysqli, "select * from `tour_images` where `t_id`='" . $tourRes['id'] . "' limit 0, 1"))
                            ?>
                        <div class="col-lg-12">
                            <div class="blog-card">
                                <div class="row align-items-center">
                                    <div class="col-lg-5 col-md-4 p-0">
                                        <div class="blog-img">
                                            <a href="#">
                                                <img src="<?php echo $sitelink; ?>/assets/tour/<?php echo $tourImages['images']; ?>"
                                                    alt="Images">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-8 p-0">
                                        <div class="blog-content">
                                            <h3>
                                                <a href="<?php echo $sitelink; ?>/tour_details/<?php echo $tourRes['id']; ?>"><?php echo ucwords($tourRes['title']); ?></a>
                                            </h3>
                                            <p>
                                                <?php echo nl2br(substr($tourRes['description'], 0, 200)); ?>
                                            </p>
                                            <a href="<?php echo $sitelink; ?>/tour_details/<?php echo $tourRes['id']; ?>"
                                                class="read-btn">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

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

                                <?php
                                $tour = mysqli_query($mysqli, "select * from `tour_place`");
                                while ($tourRes = mysqli_fetch_assoc($tour)) {
                                    $tourImages = mysqli_fetch_assoc(mysqli_query($mysqli, "select * from `tour_images` where `t_id`='" . $tourRes['id'] . "' limit 0, 1"))
                                        ?>
                                    <article class="item">
                                        <a href="#" class="thumb">
                                        <img style="width:100px" src="<?php echo $sitelink; ?>/assets/tour/<?php echo $tourImages['images']; ?>"
                                                    alt="Images">
                                        </a>
                                        <div class="info">
                                            <h4 class="title-text">
                                                <a href="blog-details.html">
                                                  <?php echo $tourRes["title"];?>
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
                                    <?php
                                }
                                ?>

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
    <!-- Blog Style Area End -->

    <?php include "include/footer.php"; ?>

</body>

</html>