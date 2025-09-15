<?php 
session_start();
include "include/config.php";
include "include/function.php";

$client_name = strtok($_SERVER['HTTP_HOST'],".");
list($news,$admin,$pagename,$id) = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
if(isset($id))
{
    $userDetails = userDetails($mysqli,$id);
}
if($_SESSION['id'] == '')
{
    echo "<script>location.replace('index')</script>";
    //break;
}
if($_SESSION['type'] != 'M')
{
  echo "<script>location.replace('index')</script>";
}
if(empty($_SESSION['csrf_token'])) 
{
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['csrf_token'];
if(isset($_POST['Submit']))
{   
  
    $csrf_token = make_safe($mysqli,$_POST['csrf_token']);

    if($csrf_token == $token)
    {
        $username = make_safe($mysqli,$_POST['username']);
        $mobile = make_safe($mysqli,$_POST['mobile']);
        $password = make_safe($mysqli,$_POST['password']);
        $passEnc = hash('sha256',$password);
        $status = make_safe($mysqli,$_POST['status']);   
        $date = date("Y-m-d");   
        $time = date("h:i:s a");

        if($_POST['Submit'] == "Create User")
        {                 
            $checkUser = mysqli_query($mysqli,"select * from `master_panel` where `username` = '".$username."'");
            if(mysqli_num_rows($checkUser)>0)
            {
                $_SESSION['task'] = "error";
                $_SESSION['msg'] = "Username Already Exists";
                header('Location: user_create?task=error');
            }
            else
            {
              
                $insertQuery = mysqli_query($mysqli,"insert into `master_panel`(`username`,`mobile`,`password`,`tmp_pass`,`type`,`status`,`date`,`time`) values('".$username."','".$mobile."','".$passEnc."','".$password."','U','".$status."','".$date."','".$time."')");
                
        
                $_SESSION['task'] = "success";
                $_SESSION['msg'] = "Username Added Successfully";
                header('Location: user_create?task=success');
            }          

        }
        else if($_POST['Submit'] == "Edit User")
        {
            $updateUser = mysqli_query($mysqli,"update `master_panel` set `mobile`='".$mobile."',`password`='".$passEnc."',`tmp_pass`='".$password."',`status`='".$status."' where `id`='".$userDetails['id']."'");

            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Username Updated Successfully";
            header('Location: '.$link.'/user_create/'.$userDetails['id']);
        }
    }
    else
    {
        $_SESSION['task'] = "error";
        $_SESSION['msg'] = "Something Wrong !!";
        header('Location: news_add?task=error');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "include/headertop.php";?>
<body>
  <div class="container-scroller"> 
    <!-- partial:partials/_navbar.html -->
    <?php include "include/header.php";?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        
      </div>
     
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php include "include/leftpanel.php";?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">

              <?php //include "include/hometab.php";?>







                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                 
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                              <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">CREATE USER</h4>
                                   <p class="card-subtitle card-subtitle-dash">( ADD AND VIEW USER )</p>
                                  </div>
                                  
                                  <div>
                                    <a href="<?php echo $link;?>/user_view" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button">VIEW USER</a>
                                  </div>
                                </div>
                                
             
                                <?php echo alertNotification($_SESSION['msg']);?>
                                  
                                <form class="row g-3" onsubmit="return validateForm()" id="add_news" method="post" enctype= multipart/form-data>
                                        <script>
                                            function CheckSpace(event)
                                            {
                                              if(event.which ==32)
                                              {
                                                  event.preventDefault();
                                                  return false;
                                              }
                                            }
                                            function validateForm() {
                                            var x = document.getElementById("mobile").value;
                                            if (x.length != 10) {
                                              alert("Mobile number must be 10 digit");
                                              document.getElementById("mobile").select();
                                              //x.select();
                                              return false;
                                            }
                                            return true;
                                          }

                                          function isNumber(evt) {
                                              evt = (evt) ? evt : window.event;
                                              var charCode = (evt.which) ? evt.which : evt.keyCode;
                                              if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                                  return false;
                                              }
                                              return true;
                                            }
                                        </script>
                                        
                                      

                                       
                                        
                                            <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label">Username</label>
                                                <input class="form-control" onkeypress="CheckSpace(event)" name="username" value="<?php echo $userDetails['username'];?>" class="form-control" />
                                                <span id="nameErrMsg"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label">Mobile</label>
                                                <input class="form-control" name="mobile" maxlength="10" id="mobile" onkeypress="return isNumber(event)" required value="<?php echo $userDetails['mobile'];?>" class="form-control" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label">Password</label>
                                                <input class="form-control" required name="password" value="<?php echo $userDetails['tmp_pass'];?>" class="form-control" />
                                            </div>
                                            
                                             <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label">Status</label>
                                                <select class="form-control" name="status">
                                                <option value="">Select One</option>
                                                <option value="y" <?php if($userDetails['status'] == 'y'){?>selected<?php }?>>Active</option>
                                                <option value="n" <?php if($userDetails['status'] == 'n'){?>selected<?php }?>>In-Active</option>
                                                </select>
                                            </div>
                                            
                                            
                                            <div class="col-md-12">
                                            <label for="inputFirstName" class="form-label">1. Username can't be changed.</label><br />
                                            <label for="inputFirstName" class="form-label"> 2. Password must have minimum 8 cherecter and maximun 14 cherecter.</label>
                                            
                                            </div>
                                                                       
                                        <div class="col-12">
                                        <input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
                                        <input type="hidden" name="countBreakUp" id="countrow" value="<?php echo $countBreakUp;?>">
                                            <button type="submit" class="btn btn-primary text-white px-5" name="Submit" value="<?php if(isset($id)){echo "Edit User";}else{ echo "Create User";}?>">Save</button>
                                        </div>
                                    </form>
                                
                              
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                     
                    </div>
                 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include "include/footer.php";?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->

  <!-- End custom js for this page-->
</body>

</html>

