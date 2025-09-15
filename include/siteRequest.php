<?php
if(isset($_POST['Submit']))
{
    $csrf_token = make_safe($mysqli,$_POST['csrf_token']);
    if($csrf_token == $_SESSION['csrf_token'])
    {
        if($_POST['Submit'] == "SignIn")
        {
            $mobile = mysqli_real_escape_string($mysqli,$_POST['mobile']);
            $password = make_safe($mysqli,$_POST['password']);
            $passEnc = hash('sha256',$password);
            $queryLogin = mysqli_query($mysqli,"select * from `user_details` where `mobile` = '".$mobile."' or `email` = '".$mobile."'");		
            $CheckdateFetch = mysqli_fetch_assoc($queryLogin);
            
            if($CheckdateFetch['password'] == $passEnc)
            {

                $_SESSION['cid'] = $CheckdateFetch['id'];
                $_SESSION['task'] = "success";
                $_SESSION['msg'] = "Login Successfull";                
                //echo "<script>location.replace('reservation?task=success')</script>";     
                header('Location: reservation?task=success');
            }
            else
            {
                
                $_SESSION['task'] = "error";
                $_SESSION['msg'] = "Something Error !!";
                header('Location:sign-in?task=error');	
            }
        }
        else if($_POST['Submit'] == "SignUp")
        {
            $fullname = make_safe($mysqli,$_POST['fullname']);
            $company = make_safe($mysqli,$_POST['company']);
            $mobile = make_safe($mysqli,$_POST['mobile']);
            $email = make_safe($mysqli,$_POST['email']);
            $password = make_safe($mysqli,$_POST['password']);
            $passEnc = hash('sha256',$password);
            $country = make_safe($mysqli,$_POST['country']);
            $state = make_safe($mysqli,$_POST['state']);
            $address = make_safe($mysqli,$_POST['address']);
            $city = make_safe($mysqli,$_POST['city']);
            $pincode = make_safe($mysqli,$_POST['pincode']);
            $checkMobile = mysqli_query($mysqli,"select * from `user_details` where `mobile`='".$mobile."' or `email`='".$email."'");
            $checkMobileCount = mysqli_num_rows($checkMobile);
            if($checkMobileCount>0)
            {
                $_SESSION['task'] = "error";
                $_SESSION['msg'] = "Emailid or Mobile Number Already Exists";
                header('Location: sign-up?task=error');
            }
            else
            {
                $insertData = mysqli_query($mysqli,"insert into `user_details`(`fullname`,`company`,`mobile`,`email`,`password`,`tmp_pass`,`country`,`state`,`address`,`city`,`pincode`) values('".$fullname."','".$company."','".$mobile."','".$email."','".$passEnc."','".$password."','".$country."','".$state."','".$address."','".$city."','".$pincode."')");
                $insid = mysqli_insert_id($mysqli);
                $_SESSION['cid'] = $insid;

                $_SESSION['task'] = "success";
                $_SESSION['msg'] = "Registration complited successfully";
                echo "<script>location.replace('reservation?task=success')</script>"; 
            }
        }
    }
    else
    {
        
        $_SESSION['task'] = "error";
        $_SESSION['msg'] = "Something Error !!";
        header('Location:404?task=error');	
    }
}
?>