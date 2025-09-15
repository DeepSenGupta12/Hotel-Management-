<?php
include "../../admin/include/config.php";
include "../../admin/include/function.php";
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
//if (isset($_POST['SUBMIT'])) {
        //if ($_POST['SUBMIT'] == "TOUR_DETAILS") {
                $tourArr = array();
                $tourdetails = mysqli_query($mysqli, "select * from `tour_place` order by `id` desc");
                while ($tourDetailsRes = mysqli_fetch_assoc($tourdetails)) {
                        $tourImagesArr = array();
                        $tourImages = mysqli_query($mysqli, "select * from `tour_images` where `t_id` = '" . $tourDetailsRes['id'] . "'");
                        while ($tourImagesRes = mysqli_fetch_assoc($tourImages)) {
                                array_push($tourImagesArr, $tourImagesRes);
                        }
                       
                        $data = array("tourDetails" => $tourDetailsRes, "tourImages" => $tourImagesArr);
                        array_push($tourArr, $data);
                }
                echo strip_tags(htmlspecialchars_decode(json_encode($tourArr), true));
                //echo json_encode($tourArr);
       // }

//}
?>