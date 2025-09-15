<?php 
session_start();
if(isset($_SESSION['id']))
{
	echo "<script>location.replace('dashboard')</script>";		
} 

if (empty($_SESSION['csrf_token'])) 
{
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
include "include/config.php";
include "include/function.php";
//echo $_SESSION['csrf_token'];
if(isset($_POST['Submit']))
{
	if($_POST['Submit'] == 'Login')	
	{
		
		$username = mysqli_real_escape_string($mysqli,$_POST['username']);
    $password = make_safe($mysqli,$_POST['password']);
        $passEnc = hash('sha256',$password);
        $csrf_token = mysqli_real_escape_string($mysqli,$_POST['csrf_token']);
        if($csrf_token == $_SESSION['csrf_token'])
        {
            //$passcodeennew = hash('sha256',$passcodeen);
            $queryLogin = mysqli_query($mysqli,"select * from `master_panel` where `username` = '".$username."'");		
            $CheckdateFetch = mysqli_fetch_assoc($queryLogin);
            
            if($CheckdateFetch['password'] ==$passEnc)
            {

                $_SESSION['id'] = $CheckdateFetch['id'];
                $_SESSION['fullname'] = $CheckdateFetch['username'];
                $_SESSION['type'] = $CheckdateFetch['type'];
                                                            
                header('Location:dashboard');
            }
            else
            {
                
                $_SESSION['task'] = "error";
                $_SESSION['msg'] = "Something Error !!";
                header('Location:index?task=error');	
            }
        }
        else
        {
            $_SESSION['task'] = "error";
            $_SESSION['msg'] = "Something Error !!";
            header('Location:index?task=error');
        }
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "include/headertop.php";?>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
        
          <div class="col-lg-4 mx-auto">
          <?php echo alertNotification($_SESSION['msg']);?>
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="<?php echo $sitelink;?>/assets/images/logo.png" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="fw-light">Sign in to continue.</h6>
              <form method="post" class="pt-3">
                <div class="form-group">
                  <input type="text" name="username" required class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" required class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                <input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
                  <button name="Submit" value="Login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                
                <div class="text-center mt-4 fw-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <?php include "include/footer.php";?>
  <!-- endinject -->
</body>

</html>
