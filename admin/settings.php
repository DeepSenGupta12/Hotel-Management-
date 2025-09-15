<?php 
session_start();
include "include/config.php";
include "include/function.php";
if($_SESSION['id'] == '')
{
    echo "<script>location.replace('index')</script>";
    //break;
}
if(empty($_SESSION['csrf_token'])) 
{
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$siteSettings = siteSettings($mysqli);
if(isset($_POST['Submit']))
{   
  
    $csrf_token = make_safe($mysqli,$_POST['csrf_token']);

    if($csrf_token == $_SESSION['csrf_token'])
    {
        $title = make_safe($mysqli,$_POST['title']);
        $description = make_safe($mysqli,$_POST['description']);
        $contact = make_safe($mysqli,$_POST['contact']);
        $altcontact = make_safe($mysqli,$_POST['altcontact']);
        $email = make_safe($mysqli,$_POST['email']);
        $altemail = make_safe($mysqli,$_POST['altemail']);
        $address = make_safe($mysqli,$_POST['address']);
        $terms = make_safe($mysqli,$_POST['terms']);
        $privacy = make_safe($mysqli,$_POST['privacy']);
        $refund = make_safe($mysqli,$_POST['refund']);
        $gst = make_safe($mysqli,$_POST['gst']);
        $gstnumber = make_safe($mysqli,$_POST['gstnumber']);
        $file_name=$_FILES["logo"]["name"];
        $file_tmp=$_FILES["logo"]["tmp_name"];
        if($_POST['Submit'] == "Create Romm")
        {
            $updateSite = mysqli_query($mysqli,"UPDATE `hotel_settings` set `title`='".$title."',`description`='".$description."',`contact`='".$contact."',`altcontact`='".$altcontact."',`email`='".$email."',`altemail`='".$altemail."',`address`='".$address."',`terms`='".$terms."',`privacy`='".$privacy."',`refund`='".$refund."',`gst`='".$gst."',`gstnumber`='".$gstnumber."' where `id`=1");
            if($file_name!='')
            {
              $file_ext = strtolower(substr($file_name, strrpos($file_name, '.') + 1));
              $newsImage = md5($file_name).time().".".$file_ext;
              move_uploaded_file($file_tmp,"../assets/logo/".$newsImage);
              $updateSiteLogo = mysqli_query($mysqli,"UPDATE `hotel_settings` set `logo`='".$newsImage."' where `id`=1");
            }
        }
        $_SESSION['task'] = "success";
        $_SESSION['msg'] = "SITE UPDATED SUCCESSFULLY";
        header('Location: settings?task=success');
    }
    else
    {
        $_SESSION['task'] = "error";
        $_SESSION['msg'] = "Something Wrong !!";
        header('Location: settings?task=error');
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
                      <form class="row g-3" onsubmit="return validateForm()" id="add_news" method="post" enctype= multipart/form-data>
                                 
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                              <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">SITE SETTINGS</h4>
                                   <p class="card-subtitle card-subtitle-dash">( ADD AND VIEW SETTINGS )</p>
                                  </div>
                                  
                                </div>
                                
             
                                <?php echo alertNotification($_SESSION['msg']);?>
                                  
                                      
                                        
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
                                                <label for="inputFirstName" class="form-label">Site Title</label>
                                                <input class="form-control" onkeypress="CheckSpace(event)" required name="title" value="<?php echo $siteSettings['title'];?>" class="form-control" />
                                                <span id="nameErrMsg"></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">Site Description</label>
                                                <textarea style="height:150px" row="5" class="form-control" name="description" class="form-control"><?php echo $siteSettings['description'];?></textarea>
                                                <span id="nameErrMsg"></span>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">Terms & Condition</label>
                                                <textarea id="terms" name="terms"><?php echo $siteSettings['terms'];?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">Privacy Policy</label>
                                                <textarea id="privacy" name="privacy"><?php echo $siteSettings['privacy'];?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">Refund Policy</label>
                                                <textarea id="refund" name="refund"><?php echo $siteSettings['refund'];?></textarea>
                                            </div>
                                            
                
                                             <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">Logo</label>
                                                <input type="file" class="form-control" name="logo" style="line-height: 2px;" />
                                                <?php
                                                if($siteSettings['logo']!='')
                                                {
                                                ?>
                                                <img style="width:100px; margin-top:5px; padding:5px; border:1px solid #222" src="<?php echo $sitelink;?>/assets/logo/<?php echo $siteSettings['logo'];?>" alt="">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            
                                            
                                            
                                            
                                            <div class="col-md-12">
                                            <label for="inputFirstName" class="form-label">1. Room add / edit panel.</label><br />
                                            <label for="inputFirstName" class="form-label"> 2. Room price must have intiger format.</label>
                                            
                                            </div>
                                                                       
                                        <div class="col-12">
                                        <input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
                                        <input type="hidden" name="countBreakUp" id="countrow" value="<?php echo $countBreakUp;?>">
                                            <button type="submit" class="btn btn-primary text-white px-5" name="Submit" value="<?php if(isset($id)){echo "Edit Room";}else{ echo "Create Romm";}?>">Save</button>
                                        </div>
                                   
                              
                              
                              
                              
                                  </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                              <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">CONTACT INFORMATION</h4>
                                   <p class="card-subtitle card-subtitle-dash">( ADD AND VIEW SETTINGS )</p>
                                  </div>
                                  
                                </div>
                                
             

                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">Contact 1</label>
                                                <input class="form-control" required name="contact" value="<?php echo $siteSettings['contact'];?>" class="form-control" />
                                                <span id="nameErrMsg"></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">Alt Contact</label>
                                                <input class="form-control" required name="altcontact" value="<?php echo $siteSettings['altcontact'];?>" class="form-control" />
                                                <span id="nameErrMsg"></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">Email</label>
                                                <input class="form-control" required name="email" value="<?php echo $siteSettings['email'];?>" class="form-control" />
                                                <span id="nameErrMsg"></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">Alt Email</label>
                                                <input class="form-control" name="altemail" value="<?php echo $siteSettings['altemail'];?>" class="form-control" />
                                                <span id="nameErrMsg"></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">Address</label>
                                                <textarea style="height:150px" required row="5" class="form-control" name="address" class="form-control"><?php echo $siteSettings['address'];?></textarea>
                                                <span id="nameErrMsg"></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">GST</label>
                                                <div class="form-group">
                                                  <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text bg-primary text-white"><i class="fa fa-inr"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" required name="gst" value="<?php echo $siteSettings['gst'];?>" placeholder="GST (type gst amount)" />
                                                    <div class="input-group-append">
                                                      <span class="input-group-text">.0</span>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">GST Number</label>
                                                <input class="form-control" name="gstnumber" required value="<?php echo $siteSettings['gstnumber'];?>" placeholder="GST number" value="<?php echo $roomDetails['title'];?>" class="form-control" />
                                                <span id="nameErrMsg"></span>
                                            </div>
                                            
                                            
                                                            
                                        
                                   
                              
                              
                              
                              
                                  </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </form>
                     
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

