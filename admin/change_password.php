
<?php
session_start();
include "include/config.php";
include "include/function.php";
// unset($_SESSION['task']);
// unset($_SESSION['msg']);
$client_name = strtok($_SERVER['HTTP_HOST'],".");
list($news,$admin,$p,$id) = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
if(isset($id))
{
    $roomDetails = roomDetails($mysqli,$id);
}
if($_SESSION['id'] == '')
{
  header('Location: '.$link.'/index');
    //break;
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
        $c_pass = make_safe($mysqli,$_POST['c_pass']);
        $m_pass = make_safe($mysqli,$_POST['m_pass']);
        $re_pass = make_safe($mysqli,$_POST['re_pass']);
        if($_POST['Submit'] == "Change Password")
        {                 
            $id = $_SESSION['id'];
            if($m_pass==$re_pass){
              $npassEnc = hash('sha256',$c_pass);
              $mpassEnc = hash('sha256',$m_pass);

              $check_current_password = mysqli_query($mysqli,"SELECT `id`,  `password` from `master_panel` where `password`= '$npassEnc' and `id`='$id' ");
              $arry = mysqli_num_rows($check_current_password);
              if($arry>0){
                
                $sql= mysqli_query($mysqli,"UPDATE `master_panel` SET `password`='$mpassEnc',tmp_pass='$m_pass' where id='$id'");
                $_SESSION['task'] = "success";
                $_SESSION['msg'] = "PASSWORD UPDATED SUCCESSFULL!!";
                header('Location: change_password?task=success');
              }
              else{
                $_SESSION['task'] = "error";
                $_SESSION['msg'] = "CURRENT PASSWORD MISMATCHED!!";
                header('Location: change_password?task=error');
              }


              


            } 
            else{
            
            $_SESSION['task'] = "error";
            $_SESSION['msg'] = "New Password & Confirm Password not matched!!";
            header('Location: change_password?task=error');
            }
            
                    

        }
        
    }
    else
    {
        $_SESSION['task'] = "error";
        $_SESSION['msg'] = "Something Wrong !!";
        header('Location: change_password?task=error');
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
                                    <h4 class="card-title card-title-dash">CHANGE PASSWORD</h4>
                                   <p class="card-subtitle card-subtitle-dash">( UPDATE YOUR PASSWORD )</p>
                                  </div>
                                  
                                  <div>
                                    <a href="<?php echo $link;?>/room_view" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button">VIEW ROOM</a>
                                  </div>
                                </div>
                                
             
                                <?php 
                                echo alertNotification($_SESSION['msg']);?>
                                  
                                <form class="row g-3" onsubmit="return validateForm()" id="add_news" method="post" enctype= multipart/form-data>
                                        
                                        
                                      <script>
                                        function isNumber(evt) {
                                              evt = (evt) ? evt : window.event;
                                              var charCode = (evt.which) ? evt.which : evt.keyCode;
                                              if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                                  return false;
                                              }
                                              return true;
                                            }
                                      </script>

                                       
                                        
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">CURRENT PASSWORD</label>
                                                <input class="form-control" name="c_pass" class="form-control" />
                                                <span id="nameErrMsg"></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">NEW PASSWORD</label>
                                                <input class="form-control" name="m_pass" class= "form-control"/>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">CONFIRM PASSWORD</label>
                                                <input class="form-control" name="re_pass" class="form-control" />
                                            </div>
                                                                                  
                                            
                                            <div class="col-md-12">
                                            <label for="inputFirstName" class="form-label">1. Room add / edit panel.</label><br />
                                            <label for="inputFirstName" class="form-label"> 2. Room price must have intiger format.</label>
                                            
                                            </div>
                                                                       
                                        <div class="col-12">
                                        <input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
                                        <input type="hidden" name="countBreakUp" id="countrow" value="<?php echo $countBreakUp;?>">
                                            <button type="submit" class="btn btn-primary text-white px-5" name="Submit" value="Change Password">Save</button>
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

