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
        <div class="inner-banner inner-bg12">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="<?php echo $sitelink;?>">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>Menu</li>
                    </ul>
                    <h3>Menu</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <?php
        $food = mysqli_query($mysqli,"select * from `food_cat`");
        while($foodRes = mysqli_fetch_assoc($food))
        {
        ?>
        <div class="breakfast-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <h2><?php echo strtoupper($foodRes['title'])?></h2>
                    <span> 8:00 AM - 12:00 PM</span>
                </div>
                <div class="row pt-45">
                    <?php
                    $foodDetails = mysqli_query($mysqli,"select * from `food_details` where `f_id`='".$foodRes['id']."'");
                    while($foodDetailsRes = mysqli_fetch_assoc($foodDetails))
                    {
                    ?>
                    <div class="col-lg-4">
                        <div class="restaurant-item">
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-md-6 p-0">
                                    <div class="restaurant-img">
                                        <img src="<?php echo $sitelink;?>/assets/food/<?php echo $foodDetailsRes['images'];?>" alt="Images">
                                    </div>
                                </div>

                                <div class="col-lg-9 col-md-6 p-0">
                                    <div class="restaurant-content">
                                        <h3><a href="#"><?php echo strtoupper($foodDetailsRes['title']);?></a></h3>
                                        
                                        <h5>CODE: <span style="color:green">[<?php echo strtoupper($foodDetailsRes['codename']);?>]</span></h5>
                                    </div>
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
        <?php
        }
        ?>
        

        <?php include "include/footer.php";?>
        
    </body>
</html>