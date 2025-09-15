<?php
include "admin/include/config.php";
include "admin/include/function.php";
$client_name = strtok($_SERVER['HTTP_HOST'],".");
$pros = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
$id = $pros[3];
?>
<!doctype html>
<html lang="zxx">
<?php include "include/headertop.php";?>
    <body>

        <?php include "include/header.php";?>
        
        <!-- End Navbar Area -->

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg3">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="<?php echo $sitelink;?>/index">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>Gallery</li>
                    </ul>
                    <h3>Gallery</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Gallery Area -->
        <div class="gallery-area pt-100 pb-70">
            <div class="container">
                <div class="gallery-tab">
                    <ul class="tabs text-center">
                        <?php
                        $sql = "SELECT * FROM `gallery_cat` ";
                        $fetchData_rec = mysqli_query($mysqli,$sql." order by `id` desc");
                        while($fetchData_Res = mysqli_fetch_assoc($fetchData_rec))                                
                        {
                        ?>
                        <li class="<?php if($fetchData_Res['id']==$id){?>active<?php }?>">
                            <a href="<?php echo $sitelink;?>/gallery/<?php echo strtoupper($fetchData_Res['id']);?>"><?php echo strtoupper($fetchData_Res['title']);?></a>
                        </li>
                        <?php
                        }
                        ?>

                    </ul>

                    <div class="tab_content current active pt-45">
                        <div class="tabs_item current">
                            <div class="gallery-tab-item">
                                <div class="gallery-view">
                                    <div class="row">
                                        <?php
                                        if(isset($id))
                                        {
                                            $gallery = mysqli_query($mysqli,"select * from `gallery_images` where `g_id`='".$id."' order by id desc");
                                        }
                                        else
                                        {
                                            $gallery = mysqli_query($mysqli,"select * from `gallery_images` order by id desc");
                                        }
                                        $count = mysqli_num_rows($gallery);
                                        if($count>0)
                                        {
                                            while($galleryRes = mysqli_fetch_assoc($gallery))
                                            {
                                            
                                            
                                            ?>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="single-gallery">
                                                    <img src="<?php echo $sitelink;?>/assets/gallery/<?php echo $galleryRes['images'];?>" alt="Images">
                                                    <a href="<?php echo $sitelink;?>/assets/gallery/<?php echo $galleryRes['images'];?>" class="gallery-icon">
                                                        <i class='bx bx-plus'></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                            }                                            
                                        }
                                        else
                                        {
                                            echo '<div class="col-lg-12 col-sm-12" style="text-align:center"><h4>No records found !!</h4></div>';
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php include "include/footer.php";?>


      
        
    </body>
</html>