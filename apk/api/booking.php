<?php
include "../../admin/include/config.php";
include "../../admin/include/function.php";
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
if (isset($_POST['SUBMIT'])) {
        if ($_POST['SUBMIT'] == "ROOM_BOOKING") {


                $booking_id = time();
                $checkIn = mysqli_real_escape_string($mysqli, $_POST['checkIn']);
                $checkOut = mysqli_real_escape_string($mysqli, $_POST['checkOut']);
                $adult = mysqli_real_escape_string($mysqli, $_POST['adult']);
                $children = mysqli_real_escape_string($mysqli, $_POST['children']);
                $roomValue = mysqli_real_escape_string($mysqli, $_POST['roomValue']);
                $fullName = mysqli_real_escape_string($mysqli, $_POST['fullName']);
                $mobile = mysqli_real_escape_string($mysqli, $_POST['mobile']);
                $email = mysqli_real_escape_string($mysqli, $_POST['email']);
                $room_no = mysqli_real_escape_string($mysqli, $_POST['room_id']);
                $customer_id =mysqli_real_escape_string($mysqli, $_POST['customer_id']);

                $insert = mysqli_query($mysqli, "insert into `room_booking`(`cname`,`cmobile`,`cemail`,`checkin`,`checkout`,`room_id`,`booking_id`,`no_room`,`cid`) value('" . $fullName . "','" . $mobile . "','" . $email . "','" . $checkIn . "','" . $checkOut . "','" . $room_no . "','".$booking_id."','".$roomValue."','".$customer_id."')");

                if ($insert) {
                        echo json_encode(array("status" => "success", "booking_id" => $booking_id));

                } else {
                        echo json_encode(array("status" => "error", "booking_id" => ''));

                }


        }

}
?>