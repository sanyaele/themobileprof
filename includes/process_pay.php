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
    private $email;
    private $mobile;
    private $for;
    
    private $course;
    private $coupon = array();

    private $unit_cost = 0;
    private $total_cost = 0;
    public $amount = 0;

    private $day;
    private $week1 = 0;
    private $week2 = 0;
    private $week3 = 0;
    private $week4 = 0;

    private $ref;
    private $callback = "https://www.seonigeria.com/process.php";

    function __construct(){
        global $link;
        $this->dblink = $link;

        if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['mobile'])){
            echo "Error: You need to fill your name and contact information before you can proceed";
            return FALSE;
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
        
        
        
        

        // Create Transaction Reference
        if ($_POST['pg'] == 'pay_training'){
            $this->ref = "Business-Training-".rand(1000,9999);
        } elseif ($_POST['pg'] == 'pay_payment') {
            $this->ref = "Payment-".rand(1000,9999);
        } else {
            $this->ref = "Webpay-".rand(1000,9999);
        }

        $_SESSION['ref'] = $this->ref; //Store ref number in session
        $_SESSION['email'] = $this->email; //Store email in session
    }

    function process_pay(){
        $data = array('email' => $this->email, 'amount' => $this->amount, "reference" => $this->ref, "callback_url" => $this->callback);

        $tranx = curl_post('https://api.paystack.co/transaction/initialize', $data);

        if (!empty($tranx['data']['authorization_url'])){
            return $tranx['data']['authorization_url'];

            // if($this->add_db($this->dblink)){
            //         header("Location: ".$tranx['data']['authorization_url']);
            // } else {
            //     throw new MyException("Couldn't add details to database");
            // }
            
        } else {
            throw new MyException("Couldn't Initialize Transaction");
        }
    }

    function get_cost($db){
        $sql = "SELECT * FROM `courses` WHERE `id` = '$this->course' LIMIT 1";
        $result = @mysqli_query($db, $sql);
        $row = @mysqli_fetch_assoc($result);

        $this->unit_cost = $row['unit_cost']*100;
        $this->total_cost = $row['total_cost']*100;
    }
    
    function add_db ($link,$paid=""){
        $coupon = (!empty($_SESSION['coupon'])) ? $_SESSION['coupon'] : "";

        $sql = "INSERT INTO `registration` SET
        `firstname` = '$this->firstname',
        `lastname` = '$this->lastname',
        `email` = '$this->email',
        `telephone` = '$this->mobile',
        $paid
        `course_id` = '$this->course',
        `coupon_name` = '$coupon',
        `week1` = '$this->week1',
        `week2` = '$this->week2',
        `week3` = '$this->week3',
        `week4` = '$this->week4',
        `ref` = '$this->ref'";
        if (@mysqli_query($link, $sql)){
            return TRUE;
            
        } else {
            return FALSE;
        }
    }
    
}

class verify {
    private $dblink;

    function __construct(){
        global $link;
        $this->dblink = $link;

        
    }

    function confirm (){
        $url = 'https://api.paystack.co/transaction/verify/'.$_SESSION['ref'];
        $tranx = curl_get ($url);

        if (!empty($tranx['data']['status'])){
            $this->edit_db($this->dblink);
            $this->send_email();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function edit_db($db){
        $sql = "UPDATE `registration` SET
        `status` = 'paid'
        WHERE 
        `ref` = '".$_SESSION['ref']."'
        LIMIT 1";
        if (@mysqli_query($db, $sql)){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function send_email (){
        // Create the email and send the message
        $details = $this->get_details($this->dblink);
        
        $to = 'contact@seonigeria.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
        $email_subject = "Payment for  ".$details['course_name'];
        $email_body = "
        Someone just sent payment for $details[course_name]\n\n".
        "Here are the details:\n\n 
        Name: $details[firstname] $details[lastname] \n\n 
        Email: $details[email]\n\n 
        Phone: $details[telephone]\n\n 
        Amount: $details[amount]\n\n 
        Course: $details[course_name]\n\n
        Coupon Name: $details[coupon_name]\n\n
        Transaction Reference: $details[ref]\n\n 
        Kindly reach out to the client to discuss further";
        $headers = "From: noreply@seonigeria.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
        $headers .= "Reply-To: ".$details['email'];   
        
        if (mail($to,$email_subject,$email_body,$headers)){
            $cont['head'] = "Application Received";
            if ($this->for == "Domain name"){
                $cont['body'] = "We have received your application, kindly click on <strong>Pay Now</strong> to pay for your domain name (".$_POST['domain']."), we will purchase it within 24 working hours. And a Project manager will be assigned to your account, who will call you on $_SESSION[mobile], to collect the materials to commence work on your website and give you details on how to proceed";
            } else {
                $cont['body'] = "We have received your application, and a Team member will call you within 24 hours to commence integration. <br>
            Thank you.";
            }
            
        } else {
            $cont['head'] = "Error Processing Request";
            $cont['body'] = "There was an error sending this request. Kindly email or call us to notify of this error. <br>
            Thank you.";
        }
    
        //return $cont;
    }

    function get_details ($db){
        $sql = "SELECT `registration`.*, `courses`.`name` AS course_name
        FROM `registration`, `courses`
        WHERE `registration`.`email` = '".$_SESSION['email']."'
        AND `registration`.`course_id` = `courses`.`id`
        LIMIT 1";
        $result = @mysqli_query($db, $sql);
        $row = @mysqli_fetch_assoc($result);
        return $row;
    }

}
?>