<?php

require_once '../includes/session_control.php';
///////////////////////////////////////////////
function get_prospects ($link){
    $sql = "SELECT `firstname`,`lastname`,`email`,`telephone`,`amount`,`status`, `pay_url`
    FROM `registration`
    WHERE `agent_id` = '".$_SESSION['userid']."'";
    $result = @mysqli_query($link, $sql);

    $tr = "";
    
    while ($rows = @mysqli_fetch_assoc($result)){
        $tr .= "<tr>
        <td data-toggle=\"tooltip\" title=\"$rows[telephone] $rows[email]\">$rows[firstname] $rows[lastname]</td>
        <td>$rows[amount]</td>
        <td>$rows[status]</td>
        <td><a href=\"$rows[pay_url]\">$rows[pay_url]</a></td>
        </tr>";
    }

    return $tr;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SEONigeria Agent Page</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <div class="container">
        <div class="top">
            
            <div class="titl">
                SEONigeria.com Agent
            </div>
            <div class="nav">
                <a href="?logoff=1">Logout</a>
            </div>
        </div>
        
        <div class="header">
            <h1>Welcome <?php echo $_SESSION['name']; ?></h1>
        </div>
        <div class="content">
            <div class="formtop">
                <form action="index.php" method="get" target="_blank">
                Coupon:
                <input type="text" name="coupon" id="coupon" placeholder="Coupon">
                <button type="submit">Proceed</button>
                </form>
                <hr>
                <div class="">Register User: <a href="https://www.seonigeria.com/mobile-pro-registration.php?agent=<?php echo $_SESSION['email']; ?>&coupon=<?php echo (!empty($_GET['coupon'])) ? $_GET['coupon'] : "" ; ?>" target="_blank">New Registration</a></div>
                <hr>
                <div class="">Link for next month's registration: <input type="text" value="https://www.seonigeria.com/a/<?php echo $_SESSION['code']; ?>/<?php echo (!empty($_GET['coupon'])) ? $_GET['coupon'] : "" ; ?>" id="nxt_mnth"></div>
                <div class="">Link for this month's registration: <input type="text" value="https://www.seonigeria.com/b/<?php echo $_SESSION['code']; ?>/<?php echo (!empty($_GET['coupon'])) ? $_GET['coupon'] : "" ; ?>" id="ths_mnth"></div>
                <div class="">Link for WhatsApp contact: <input type="text" value="https://www.seonigeria.com/w/<?php echo $_SESSION['code']; ?>/<?php echo (!empty($_GET['coupon'])) ? $_GET['coupon'] : "" ; ?>" id="nxt_whatsapp"></div>
            </div>
            <hr style="color: rgb(24, 89, 150);">
            <div class="content_main">
                <h2>Prospects</h2>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Payment Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $prospect_table = get_prospects ($link);
                            echo $prospect_table;
                        ?>
                        
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="footer">
        
        </div>
    </div>
    

</body>
</html>