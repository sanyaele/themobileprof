<?php
if (!empty($_GET['a'])){
    header("Location: https://www.seonigeria.com/mobile-business-training.php?ref=".addslashes($_GET['a'])."&coupon=".addslashes($_GET['c']));
} else {
    header("HTTP/1.0 403 Forbidden");
    die("You are not allowed to access this file");
}
?>