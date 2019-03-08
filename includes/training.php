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

class getSeats {

    function __construct(){

    }
    function seats ($db, $day, $mY){
        $sql = "SELECT SUM(`seats`) AS `seats` FROM `registration`
        WHERE `class_day` = '$day'
        AND `month_year` = '$mY'";

        //echo $sql;

        $result = @\mysqli_query($db, $sql);
        $row = @\mysqli_fetch_assoc($result);
        return $row['seats'];
    }
}
?>