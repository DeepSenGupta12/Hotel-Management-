<?php
include "../../admin/include/config.php";
include "../../admin/include/function.php";
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
if (isset($_POST['SUBMIT'])) {
        if ($_POST['SUBMIT'] == "ROOM_DETAILS") {
                $roomArr = array();
                $rommDetails = mysqli_query($mysqli, "select * from `room_category` order by `id` desc");
                while ($rommDetailsRes = mysqli_fetch_assoc($rommDetails)) {
                        $roomImagesArr = array();
                        $roomImages = mysqli_query($mysqli, "select * from `room_images` where `room_id` = '" . $rommDetailsRes['id'] . "'");
                        while ($roomImagesRes = mysqli_fetch_assoc($roomImages)) {
                                array_push($roomImagesArr, $roomImagesRes);
                        }
                        $roomFacilitiesArr = array();
                        $roomFacilities = mysqli_query($mysqli, "select * from `room_facility_set` where `room_id` = '" . $rommDetailsRes['id'] . "'");
                        while ($roomFacilitiesRes = mysqli_fetch_assoc($roomFacilities)) {
                                $roomFacilitiesDetails = roomFacilities($mysqli, $roomFacilitiesRes['f_id']);
                                array_push($roomFacilitiesArr, $roomFacilitiesDetails);
                        }
                        $data = array("roomDetails" => $rommDetailsRes, "roomImages" => $roomImagesArr, "roomFacilities" => $roomFacilitiesArr);
                        array_push($roomArr, $data);
                }
                echo json_encode($roomArr);
        }

}
?>