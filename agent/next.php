<?php
// next.php

require_once '../includes/session_control.php';
///////////////////////////////////////////////

class agent_register {
    private $coupon = "";

    function __construct (){
        if (!empty($_POST['coupon'])){
            $this->coupon = addslashes($_POST['coupon']);
        }

        if ($_POST['register'] == "Yes"){
            // redirect to regitration page
            header("Location: https://www.seonigeria.com/mobile-business-training.php?agent=".$_SESSION['email']."&coupon=".$this->coupon);
        } else {
            echo "Copy and Send the user this URL: https://www.seonigeria.com/a/?a=".$_SESSION['code']."&c=".$this->coupon;
            exit();
        }
    }
}
if (!empty($_POST['register'])){
    $register = new agent_register;
} else {
    header("HTTP/1.0 403 Forbidden");
    die("You are not allowed to access this file");

}
?>