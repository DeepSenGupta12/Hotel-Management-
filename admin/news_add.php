<?php 
session_start();
include "include/config.php";
include "include/function.php";
require_once ('../vendor/autoload.php');
use \Statickidz\GoogleTranslate;
$trans = new GoogleTranslate();
$client_name = strtok($_SERVER['HTTP_HOST'],".");
list($news,$admin,$pagename,$id) = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
if(isset($id))
{
    $newsDetails = newsDetails($mysqli,$id);
}
if($_SESSION['id'] == '')
{
    echo "<script>location.replace('index')</script>";
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
        $catid = make_safe($mysqli,$_POST['catid']);
        $language = make_safe($mysqli,$_POST['language']);
        $title = make_safe($mysqli,$_POST['title']);
        
        $shortdesc = make_safe($mysqli,$_POST['shortdesc']);
        $longdesc = make_safe($mysqli,$_POST['longdesc']);
        $tags = make_safe($mysqli,$_POST['tags']);  
        $date = date("Y-m-d");   
        $time = date("h:i:s a");
        $videourl = make_safe($mysqli,$_POST['videourl']);
        $file_name=$_FILES["img"]["name"];

        $total_p = make_safe($mysqli,$_POST['total_p']);


        //$ln = $_POST['ln'];
        //$title = $_POST['title'];
        $source = $language;
        $target = 'en';
        $text = $title;

        $trans = new GoogleTranslate();
        $result = $trans->translate($source, $target, $text);
        $linktitle = make_safe($mysqli,substr(string_sanitize($result),0,100));
        //$linktitle = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $string);   

        //exit;
        
        //echo $_POST['title'];exit;
     
        if($_POST['Submit'] == "Create News")
        {
                   
           
            $createStudent = mysqli_query($mysqli,"INSERT INTO `news_details` (`loginid`,`catid`, `language`,`videourl`, `title`, `linktitle`, `shortdesc`, `longdesc`,`tags`,`date`,`time`) VALUES ('".$_SESSION['id']."','".$catid."', '".$language."','".$videourl."', '".$title."', '".$linktitle."', '".$shortdesc."', '".$longdesc."','".$tags."','".$date."','".$time."');");
            $insid = mysqli_insert_id($mysqli);
            if($file_name!='')
            {
              $file_ext = strtolower(substr($file_name, strrpos($file_name, '.') + 1));
              $newsImage = md5($file_name).time().".".$file_ext;
              move_uploaded_file($file_tmp=$_FILES["img"]["tmp_name"],"../images/news/".$newsImage);
              resize(650,"../images/news/".$newsImage,"../images/news/".$newsImage);
              $galleryIns = mysqli_query($mysqli,"UPDATE `news_details` set `imageurl`='".$newsImage."' where `id`='".$insid."'");
            }

            for($i=1;$i<=$total_p;$i++)
            {
                $pid = $_POST['pid'.$i];
                if($pid!='')
                {
                  $insertnewsPanel = mysqli_query($mysqli,"insert into `news_panel`(`nid`,`pid`) values('".$insid."','".$pid."')");
                }
            }
            
     
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "News Added Successfully";
            header('Location: news_add?task=success');
           

        }
        else if($_POST['Submit'] == "Edit News")
        {
            $updateStudent = mysqli_query($mysqli,"update `news_details` set `loginid`='".$_SESSION['id']."',`catid`='".$catid."',`language`='".$language."',`videourl`='".$videourl."',`title`='".$title."',`linktitle`='".$linktitle."',`shortdesc`='".$shortdesc."',`longdesc`='".$longdesc."',`tags`='".$tags."' where `id` = '".$newsDetails['id']."'");
            if($file_name!='')
            {
                @unlink('../images/news/'.$newsDetails['imageurl']);
                $file_ext = strtolower(substr($file_name, strrpos($file_name, '.') + 1));
                $newsImage = md5($file_name).time().".".$file_ext;
                move_uploaded_file($_FILES["img"]["tmp_name"],"../images/news/".$newsImage);
                //resize_image("../images/news/".$imageName,750,'',false);
                resize(750,"../images/news/".$newsImage,"../images/news/".$newsImage);
                $galleryIns = mysqli_query($mysqli,"UPDATE `news_details` set `imageurl`='".$newsImage."' where `id`='".$newsDetails['id']."'");
            }
            $deleleNewsPosition = mysqli_query($mysqli,"delete from `news_panel` where `nid`='".$newsDetails['id']."'");
            for($i=1;$i<=$total_p;$i++)
            {
                $pid = $_POST['pid'.$i];
                if($pid!='')
                {
                  $insertnewsPanel = mysqli_query($mysqli,"insert into `news_panel`(`nid`,`pid`) values('".$newsDetails['id']."','".$pid."')");
                }
            }


            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "News Updated Successfully";
            header('Location: '.$link.'/news_add/'.$newsDetails['id']);
        }
    }
    else
    {
        $_SESSION['task'] = "error";
        $_SESSION['msg'] = "Something Wrong !!";
        header('Location: news_add?task=error');
    }
}

function resize_image($file, $w, $h, $crop=FALSE) {
  list($width, $height) = getimagesize($file);
  $r = $width / $height;
  if ($crop) {
      if ($width > $height) {
          $width = ceil($width-($width*abs($r-$w/$h)));
      } else {
          $height = ceil($height-($height*abs($r-$w/$h)));
      }
      $newwidth = $w;
      $newheight = $h;
  } else {
      if ($w/$h > $r) {
          $newwidth = $h*$r;
          $newheight = $h;
      } else {
          $newheight = $w/$r;
          $newwidth = $w;
      }
  }
  $src = imagecreatefromjpeg($file);
  $dst = imagecreatetruecolor($newwidth, $newheight);
  imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

  return $dst;
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
                                    <h4 class="card-title card-title-dash">ADD NEWS</h4>
                                   <p class="card-subtitle card-subtitle-dash">( NEWS ADD AND UPDATE )</p>
                                  </div>
                                  
                                  <div>
                                    <a href="<?php echo $link;?>/news_view" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button">VIEW NEWS</a>
                                  </div>
                                </div>
                                
             
                                <?php echo alertNotification($_SESSION['msg']);?>
                                  
                                <form class="row g-3" id="add_news" method="post" enctype= multipart/form-data>
                                        <script>
                                            function AvoidSpace(event) {
                                                var k = event ? event.which : window.event.keyCode;
                                                if (k == 32) return false;
                                            }
                                        </script>
                                        
                                      

                                       
                                        
                                            <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label">News Category</label>
                                                <select class="form-control" name="catid">
                                                <option value="">Select One</option>
                                                <?php
                                                $newsCat = newsCat($mysqli);
                                                foreach($newsCat as $cat)
                                                {
                                                ?>
                                                <option <?php if($newsDetails['catid'] == $cat['id']){?>selected<?php }?> value="<?php echo $cat['id'];?>"><?php echo ucwords($cat['title']);?></option>
                                                <?php
                                                }
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label">Select Language</label>
                                                <select class="form-control" name="language" id="ln">
                                                <option value="">Select One</option>
                                                <?php
                                                $newsLanguage = newsLanguage($mysqli);
                                                foreach($newsLanguage as $language)
                                                {
                                                ?>
                                                <option <?php if($newsDetails['language'] == $language){?>selected<?php }?> value="<?php echo $language;?>"><?php echo strtoupper($language);?></option>
                                                <?php
                                                }
                                                ?>
                                                
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                            <h4 class="card-title card-title-dash">NEWS POSITION</h4>
                                            </div>
                                            <?php
                                                $newsPosition = newsPosition($mysqli);
                                                foreach($newsPosition as $key=>$position)
                                                {
                                                  $p = round($key+1);

                                                    $checkNewsPosition = checkNewsPosition($mysqli,$newsDetails['id'],$position['id']);
                                                    //echo $checkNewsPosition['pid'];
                                                ?>
                                             <div class="col-md-4">
                                                <label for="inputFirstName" class="form-label"><?php echo $position['title'];?></label>
                                                <input type="checkbox" <?php if($checkNewsPosition['pid']==$position['id']){?>checked<?php }?> value="<?php echo $position['id'];?>" name="pid<?php echo $p;?>" />
                                            </div>
                                            <?php
                                                }
                                                ?>
                                            <input type="hidden" name="total_p" value="<?php echo count($newsPosition);?>">
                                            <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Upload News Image</label><br />
                                            <input style="clear:both" type="file" id="files" name="img" />
                                            <?php
                                            if(isset($id))
                                            {
                                            ?>
                                            <br />
                                            <img style="width:200px; margin:10px 0px" src="<?php echo $sitelink;?>/images/news/<?php echo $newsDetails['imageurl'];?>" alt="">
                                            <?php
                                            }
                                            ?>
                                            </div>
                                            <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label">Video Url (If available)</label>
                                            <input class="form-control" name="videourl" value="<?php echo $newsDetails['videourl'];?>" class="form-control" />
                                            </div>
                                            <div class="col-md-12">
                                                <h5>NEWS TITLE:</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <textarea style="height:auto" name="title" id="title" class="form-control" rows="3"><?php echo $newsDetails['title'];?></textarea>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <h5>NEWS SHORT DESCRIPTION :</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <textarea style="height:auto" name="shortdesc" class="form-control" rows="3"><?php echo $newsDetails['shortdesc'];?></textarea>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <h5>NEWS LONG DESCRIPTION :</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <textarea style="height:auto" id="editor1"  name="longdesc" class="form-control" rows="3"><?php echo $newsDetails['longdesc'];?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <h5>TAG INPUTS :</h5>
                                            </div>
                                            <div class="col-md-12">
                                              <input class="form-control" id="tags-input" data-role="tagsinput" name="tags" value="<?php echo $newsDetails['tags'];?>" class="form-control" />
                                            </div>
                                            <script>
                                                // Replace the <textarea id="editor1"> with a CKEditor 4
                                                // instance, using default configuration.
                                                CKEDITOR.replace( 'editor1' );
                                            </script>
                                            <div class="col-md-12">
                                                <h5>CERTIFICATE :</h5>
                                            </div>
                                            <div class="col-md-12">
                                            <label for="inputFirstName" class="form-label">1. I fully understand that the School, on accepting the registration form from my ward, is not in any way bound to  grant admission, as the admission is based on the availability of seats and qualification in the interview.</label>
                                            <label for="inputFirstName" class="form-label"> 2. I also accept that the decisions of the  Principal / Admission Committee regarding admission are final and binding.</label>
                                            <label for="inputFirstName" class="form-label"> 3. I further undertake to abide by the School Rules.</label>
                                            </div>
                                                                       
                                        <div class="col-12">
                                        <input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
                                        <input type="hidden" name="countBreakUp" id="countrow" value="<?php echo $countBreakUp;?>">
                                            <button type="submit" class="btn btn-primary text-white px-5" name="Submit" value="<?php if(isset($id)){echo "Edit News";}else{ echo "Create News";}?>">Save</button>
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

