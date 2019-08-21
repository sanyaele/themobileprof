<?php
namespace Process;

class MyException extends \Exception { }

require_once 'common.php';
require_once 'training.php';

use Training\coupon AS couponClass;


class process {
    private $dblink;
    
    private $firstname;
    private $lastname;
    public $email;
    private $mobile;
    private $for;
    
    private $course;
    private $course_name;
    private $coupon = array();

    private $unit_cost = 0;
    private $total_cost = 0;
    public $amount = 0;
    private $seats = 1;

    private $day = "monday";
    private $mY;
    private $week1 = 0;
    private $week2 = 0;
    private $week3 = 0;
    private $week4 = 0;

    private $agent = 0;
    public $ref;
    private $callback = "https://www.seonigeria.com/confirm.php";
    private $pay_url;

    function __construct($link){
        $this->dblink = $link;

        if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['mobile']) || empty($_POST['day']) || empty($_POST['monthYear']) || (empty($_POST['week1']) && empty($_POST['week2']) && empty($_POST['week3']) && empty($_POST['week4'])) ){
            echo "Error: You need to fill your name, contact and at least one week before you can proceed";
            exit();
            return FALSE;
        }

        if (empty($_POST['seats'])){
            echo "There are no available seats for ".$_POST['day'];
            exit();
            return FALSE;
        } else {
            $this->seats = addslash($_POST['seats']);
        }

        if (!empty($_SESSION['agent'])){
            $this->agent = $_SESSION['agent'];
        }

        $this->course = $_SESSION['course'];
        // Get cost
        $this->get_cost($this->dblink);

        $discount = new couponClass($_POST['coupon']);
        $this->coupon = $discount->get_coupon($this->dblink);

        $this->firstname = addslash($_POST['firstname']);
        $this->lastname = addslash($_POST['lastname']);
        $this->email = addslash ($_POST['email']);
        $this->mobile = addslash ($_POST['mobile']);
        $this->for = addslash($_POST['for']);
        


        $this->day = addslash($_POST['day']);
        $this->mY = addslash($_POST['monthYear']);


        if (!empty($_POST['week1'])){
            $this->week1 = 1;

            if (empty($this->coupon['week1'])){ //If coupon doesn't cover week 1
                $this->amount += $this->unit_cost;
            }
            
        }

        if (!empty($_POST['week2'])){
            $this->week2 = 1;
            
            if (empty($this->coupon['week2'])){ //If coupon doesn't cover week 2
                $this->amount += $this->unit_cost;
            }
        }

        if (!empty($_POST['week3'])){
            $this->week3 = 1;
            
            if (empty($this->coupon['week3'])){ //If coupon doesn't cover week 3
                $this->amount += $this->unit_cost;
            }
        }

        if (!empty($_POST['week4'])){
            $this->week4 = 1;
            
            if (empty($this->coupon['week4'])){ //If coupon doesn't cover week 4
                $this->amount += $this->unit_cost;
            }
        }
        
        
        // Multiple by number of Seats
        $this->amount = $this->amount * $this->seats;
        

        // Create Transaction Reference
        $this->ref = str_replace(' ', '', $this->course_name).rand(1000,9999);
        
        // Recreate call back url with transaction reference
        $this->callback .= "?ref=".$this->ref;

        
    }

    function process_pay(){
        $data = array('email' => $this->email, 'amount' => $this->amount*100, "reference" => $this->ref, "callback_url" => $this->callback);

        $tranx = curl_post('https://api.paystack.co/transaction/initialize', $data);

        if (!empty($tranx['data']['authorization_url'])){
            $this->pay_url = $tranx['data']['authorization_url'];
            
            return $tranx['data']['authorization_url'];

        } else {
            throw new MyException("Couldn't Initialize Transaction");
        }
    }

    function get_cost($db){
        $sql = "SELECT * FROM `courses` WHERE `id` = '$this->course' LIMIT 1";
        $result = @mysqli_query($db, $sql);
        $row = @mysqli_fetch_assoc($result);

        $this->course_name = $row['name'];
        $this->unit_cost = $row['unit_cost'];
        $this->total_cost = $row['total_cost'];
    }
    
    function add_db ($link,$paid=""){
        $coupon = (!empty($_SESSION['coupon'])) ? $_SESSION['coupon'] : "";

        $sql = "INSERT INTO `registration` SET
        `firstname` = '$this->firstname',
        `lastname` = '$this->lastname',
        `email` = '$this->email',
        `telephone` = '$this->mobile',
        `amount` = '$this->amount',
        $paid
        `course_id` = '$this->course',
        `coupon_name` = '$coupon',
        `seats` = '$this->seats',
        `class_day` = '$this->day',
        `month_year` = '$this->mY',
        `week1` = '$this->week1',
        `week2` = '$this->week2',
        `week3` = '$this->week3',
        `week4` = '$this->week4',
        `agent_id` = '$this->agent',
        `ref` = '$this->ref',
        `pay_url` = '$this->pay_url'";
        //echo $sql;
        if (mysqli_query($link, $sql)){
            return TRUE;
            
        } else {
            return FALSE;
        }
    }

    function send_payment_email(){

        $to = $this->email; 
        $email_subject = "Confirm registration for ".$this->course_name;
        $email_body = "This is to confirm your registration for ".$this->course_name."\n\n".
        "<a href='".$this->pay_url."'>Pay Now!</a>"."\n\n".
        "Here are the details:\n\n 
        Name: ".$this->firstname." ".$this->lastname." \n\n
        Phone: ".$this->mobile."\n\n 
        Amount: ".$this->amount."\n\n 
        Course: ".$this->course_name."\n\n
        Number of Seats: ".$this->seats."\n\n".
        "Kindly click $this->pay_url to pay for your registration as soon as possible. Please note that if the class fills up (10 persons per class) before your payment, your registration will be forfeited and your money refunded."."\n\n".
        "Thank you."."\n\n". 
        "The SEONigeria Team";
        $headers = "From: noreply@seonigeria.com\n"; 
        $headers .= "Reply-To: contact@seonigeria.com";   
        
        if (mail($to,$email_subject,$email_body,$headers)){

            return TRUE;
        } else {
            return FALSE;
        }
    }
    
}

class verify {
    private $dblink;
    private $ref;
    private $details = array();

    function __construct($link, $ref){
        $this->dblink = $link;

        $this->ref = \addslash($ref);
    }

    function confirm (){
        $url = 'https://api.paystack.co/transaction/verify/'.$this->ref;
        $tranx = curl_get ($url);
        // print_r ($tranx);

        if (!empty($tranx['data']['status'])){
            $this->details = $this->get_details($this->dblink); // Get registration details
            $this->edit_db($this->dblink); // Update registration as paid
            $this->send_admin_email();
            $this->send_user_email();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function edit_db($db){
        $sql = "UPDATE `registration` SET
        `status` = 'paid'
        WHERE 
        `ref` = '$this->ref'
        LIMIT 1";
        if (@mysqli_query($db, $sql)){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function send_admin_email (){
        // Create the email and send the message
        
        
        $to = 'contact@seonigeria.com'; 
        $email_subject = "Payment for  ".$this->details['course_name'];
        $email_body = "Someone just sent payment for ".$this->details['course_name']."\n\n".
        "Here are the details:\n\n 
        Name: ".$this->details['firstname']." ". $this->details['lastname'] ."\n\n 
        Email: ".$this->details['email']."\n\n 
        Phone: ".$this->details['telephone']."\n\n 
        Amount: ".$this->details['amount']."\n\n 
        Course: ".$this->details['course_name']."\n\n
        Coupon Name: ".$this->details['coupon_name']."\n\n
        Transaction Reference: ".$this->details['ref']."\n\n".
        "Kindly reach out to the client to discuss further";
        $headers = "From: noreply@seonigeria.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
        $headers .= "Reply-To: ".$this->details['email'];   
        
        if (mail($to,$email_subject,$email_body,$headers)){

            return TRUE;
        } else {
            return FALSE;
        }
    
    }

    

    function send_user_email (){
        
        $to = $this->details['email']; 
        $email_subject = "Payment for  ".$this->details['course_name'];
        $email_body = "We have received your registration for ".$this->details['course_name']."\n\n".
        "Here are the details:\n\n 
        Name: ".$this->details['firstname']." ".$this->details['lastname']." \n\n
        Phone: ".$this->details['telephone']."\n\n 
        Amount: ".$this->details['amount']."\n\n 
        Course: ".$this->details['course_name']."\n\n
        Coupon Name: ".$this->details['coupon_name']."\n\n".
        "Venue: 3 Thorborn Avenue, Sabo, Yaba. 1st Floor (Above the Liberian Consulate)"."\n".
        "Time: 10am to 1pm"."\n".
        "Days: ".$this->details['class_day']."\n\n".
        "For Any further Clarifications, please call Samuel on 08033954301.";
        $headers = "From: noreply@seonigeria.com\n"; 
        $headers .= "Reply-To: contact@seonigeria.com";   
        
        if (mail($to,$email_subject,$email_body,$headers)){

            return TRUE;
        } else {
            return FALSE;
        }
    
    }

    function get_details ($db){
        $sql = "SELECT `registration`.*, `courses`.`name` AS course_name
        FROM `registration`, `courses`
        WHERE `registration`.`ref` = '$this->ref'
        AND `registration`.`course_id` = `courses`.`id`
        LIMIT 1";
        $result = @mysqli_query($db, $sql);
        $row = @mysqli_fetch_assoc($result);
        return $row;
    }

}
?>