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

        // redirect to registration page
        header("Location: https://www.seonigeria.com/mobile-business-training.php?agent=".$_SESSION['email']."&coupon=".$this->coupon);
        
    }
}
if (!empty($_POST['register'])){
    $register = new agent_register;
} else {
    header("HTTP/1.0 403 Forbidden");
    die("You are not allowed to access this file");

}
?>
