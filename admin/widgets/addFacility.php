<?php
session_start();
include '../include/config.php';
include '../include/function.php';
$client_name = strtok($_SERVER['HTTP_HOST'],".");
list($news,$admin,$w,$id) = explode("/",trim($_SERVER['REQUEST_URI'],"/"));
if(empty($_SESSION['csrf_token'])) 
{
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if(isset($id))
{
    $roomFacility = roomFacility($mysqli,$id);
}

?>
<div class="modal-header">
  
  <h4 class="modal-title">ADD FACILITY</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form class="row g-3" onsubmit="return validateForm()" id="add_news" method="post" enctype= multipart/form-data>
                                        
                                        
                        
  
                                         
                                          
                                              <div class="col-md-12">
                                                  <label for="inputFirstName" class="form-label">Title</label>
                                                  <input class="form-control" name="title" value="<?php echo $roomFacility['title'];?>" class="form-control" />
                                                  <span id="nameErrMsg"></span>
                                              </div>
                                              <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">Facility Image</label>
                                                <input type="file" class="form-control" name="img" style="line-height: 2px;" />
                                                <?php
                                                if(isset($id))
                                                {
                                                ?>
                                                <img style="width:100px; margin-top:5px; padding:5px; border:1px solid #222" src="<?php echo $sitelink;?>/assets/services/<?php echo $roomFacility['images'];?>" alt="">
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
                                          <input type="hidden" value="<?php echo $roomFacility['id'];?>" name="fid">
                                          <input type="hidden" name="countBreakUp" id="countrow" value="<?php echo $countBreakUp;?>">
                                              <button type="submit" class="btn btn-primary text-white px-5" name="Submit" value="<?php if(isset($id)){echo "Edit Facility";}else{ echo "Add Facility";}?>">Save</button>
                                          </div>
                                      </form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>