<?php

require_once '../includes/session_control.php';
///////////////////////////////////////////////

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
        <div class="nav">
            <a href="?logoff=1">Logout</a>
        </div>
        <div class="header">
            <h1>Welcome <?php echo $_SESSION['name']; ?></h1>
        </div>
        <div class="content">
            <div class="formtop">
                <form action="next.php" method="post" target="_blank">
                Coupon: <input type="text" name="coupon" id="coupon"><br>
                <select name="register" id="register">
                    <option value="Yes">I want to register for User</option>
                    <option value="No">User wants to register by themselves</option>
                </select>
                <button type="submit">Proceed</button>
                </form>
            </div>
            <hr>
            <div class="content_main">
            
            </div>
        </div>
        <div class="footer">
        
        </div>
    </div>
    

</body>
</html>