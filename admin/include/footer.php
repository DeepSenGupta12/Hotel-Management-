<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"> <a href="https://www.netdemi.com/" target="_blank">netdemi</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
    </div>
</footer>
<?php
if(isset($_SESSION['last_action'])){
    $expireAfter = 5;
    $inactiveTime = time() - $_SESSION['last_action'];
    $expireAfterSeconds = $expireAfter * 1;
        if($inactiveTime >= $expireAfterSeconds){
            unset($_SESSION['task']);
        unset($_SESSION['msg']);
    }
}
?>