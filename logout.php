<?php
session_start();
session_destroy();
include "admin/include/config.php";
header('Location:'.$sitelink.'/sign-in');
?>