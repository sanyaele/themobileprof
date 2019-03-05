<?php
namespace Training;


class coupon {
    public $dblink;
    private $coupon;

    function __construct ($coupon){
        global $link;
        $this->dblink = $link;

        $this->coupon = addslashes($coupon);
    }

    function get_coupon ($db){
        $sql = "SELECT * FROM `coupons` WHERE `name` = '$this->coupon' LIMIT 1";
        $result = @mysqli_query($db, $sql);
        $row = @mysqli_fetch_assoc($result);
        return $row;
    }
}


?>