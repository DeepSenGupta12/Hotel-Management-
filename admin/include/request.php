<?php
if(isset($_POST['Submit']))
{
    $csrf_token = mysqli_real_escape_string($mysqli,$_POST['csrf_token']);
    if($csrf_token == $_SESSION['csrf_token'])
    {
        if($_POST['Submit'] == "Edit Gallery")
        {
            $g_id = make_safe($mysqli,$_POST['g_id']);
            $title = make_safe($mysqli,$_POST['title']);
            $updateGallery = mysqli_query($mysqli,"update `gallery_cat` set `title`='".$title."' where `id`='".$g_id."'");
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Gallery updated successfully !!";
            header('Location: gallery_view?task=success');

        }
        else if($_POST['Submit'] == "Add Gallery")
        {
            $title = make_safe($mysqli,$_POST['title']);
            $addCategory = mysqli_query($mysqli,"insert into `gallery_cat`(`title`) values('".$title."')");
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Category Added Successfully";
            header('Location: '.$link.'/gallery_view/?task=success'); 
        }
        else if($_POST['Submit'] == "Add Food Category")
        {
            $title = make_safe($mysqli,$_POST['title']);
            $addCategory = mysqli_query($mysqli,"insert into `food_cat`(`title`) values('".$title."')");
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Food Category Added Successfully";
            header('Location: '.$link.'/food_menu/?task=success'); 
        }
        else if($_POST['Submit'] == "Edit Food Category")
        {
            $f_id = make_safe($mysqli,$_POST['f_id']);
            $title = make_safe($mysqli,$_POST['title']);
            $addCategory = mysqli_query($mysqli,"update `food_cat` set `title`='".$title."' where `id`='".$f_id."'");
            $_SESSION['task'] = "success";
            $_SESSION['msg'] = "Food Category Updated Successfully";
            header('Location: '.$link.'/food_category/?task=success'); 
        }
    }
    else
    {
        $_SESSION['task'] = "error";
        $_SESSION['msg'] = "Something Wrong !!";
        header('Location: gallery_view?task=error');
    }
}
?>