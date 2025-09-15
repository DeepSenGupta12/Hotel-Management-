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

$foodCat = foodCat($mysqli,$id);


?>
<div class="modal-header">
  
  <h4 class="modal-title">ADD FOOD CATEGORY</h4><button type="button" class="close close_w" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form class="row g-3" onsubmit="return validateForm()" id="add_news" method="post" enctype= multipart/form-data>
                                      
                          
                                          
    <div class="col-md-12">
        <label for="inputFirstName" class="form-label">Title</label>
        <input class="form-control" name="title" value="<?php echo $foodCat['title'];?>" class="form-control" />
        <span id="nameErrMsg"></span>
    </div>
    
    
    
    <div class="col-md-12">
    <label for="inputFirstName" class="form-label">1. Only jpg and jpeg file uploaded.</label><br />
    <label for="inputFirstName" class="form-label"> 2. At t time 4 images hasbeen uploaded.</label>
    
    </div>
                                
<div class="col-12">
<input type="hidden" value="<?php echo $_SESSION['csrf_token'];?>" name="csrf_token">
<input type="hidden" value="<?php echo $foodCat['id'];?>" name="f_id">
<input type="hidden" name="countBreakUp" id="countrow" value="<?php echo $countBreakUp;?>">
    <button type="submit" class="btn btn-primary text-white px-5" name="Submit" value="<?php if($foodCat['id']!=''){echo "Edit Food Category";}else{ echo "Add Food Category";}?>">Save</button>
</div>
</form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>