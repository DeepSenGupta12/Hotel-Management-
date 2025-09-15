<?php
include "../../admin/include/config.php";
include "../../admin/include/function.php";
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
if (isset($_POST['SUBMIT'])) {
        if ($_POST['SUBMIT'] == "LOGIN") {
                $mobile = mysqli_real_escape_string($mysqli, $_POST['mobile']);
                $password = make_safe($mysqli, $_POST['password']);
                $passEnc = hash('sha256', $password);
                $queryLogin = mysqli_query($mysqli, "select * from `user_details` where `mobile` = '" . $mobile . "'");
                $CheckdateFetch = mysqli_fetch_assoc($queryLogin);

                if ($CheckdateFetch['password'] == $passEnc) {
                        echo json_encode(array("status" => "success", "login_id" => $CheckdateFetch['id']));

                } else {
                        echo json_encode(array("status" => "error", "login_id" => ''));

                }

        }

}
?>