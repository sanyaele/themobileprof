<?php
function get_date_range ($day="Monday", $month=""){
    if (!empty($month)){
      $monthYear = $month." ".date("Y");
    } else {
      $monthYear = date("F Y", strtotime("next month"));
    }
  
    $dates['my'] = $monthYear;
    
    $dates['fourth'] = date("l jS F, Y", strtotime("last $day of $monthYear"));
    $dates['third'] = date("l jS F, Y", strtotime("last $day of $monthYear - 7 days"));
    $dates['second'] = date("l jS F, Y", strtotime("last $day of $monthYear - 14 days"));
    $dates['first'] = date("l jS F, Y", strtotime("last $day of $monthYear - 21 days"));
  //echo "last $day of $monthYear";
  
    return $dates;
}

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