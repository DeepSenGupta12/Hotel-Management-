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
                        <li>Sign In</li>
                    </ul>
                    <h3>Sign In</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Sign In Area -->
        <br />
        <?php include "widgets/sign_inWidget.php";?>
        <br />
        <!-- Sign In Area End -->

        <!-- Footer Area -->
        <?php include "include/footer.php";?>
       
        
    </body>
</html>