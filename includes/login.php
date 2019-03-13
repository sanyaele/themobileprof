<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login to proceed</title>
    <style>
        body {
            background-color: #AAAAAA;
            font-family: verdana, Tahoma;
            font-size: 13px;
            color: #666666;
        }
        .message {
            font-size: 23px;
            color: #EE2222;
            padding-top: 5px;
            padding-bottom: 15px;
        }
        .cover {
            width: 400px;
            height: 200px;
            margin: auto;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background-color: #FFFFFF;
            border-radius: 10px;
            padding: 10px;
            position: fixed;
        }
        .divleft {
            width: 150px;
            float: left;
        }

        .divright {
            width: 200px;
            float: left;
        }
        button {
            padding: 10px;
            background-color: #00AA66;
            color: #FFFFFF;
            border-radius: 10px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="cover">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="message"><?php echo (!empty($mess)) ? $mess : ""; ?></div>
            <div class="divleft">Email: </div>
            <div class="divright"> <input type="text" name="email" id="email"> </div>
            <div class="divleft"> Password </div>
            <div class="divright"> <input type="password" name="password" id="password"> </div>

            <div style="text-align: center;"> <button type="submit">Login</button> </div>
        </form>
    </div>
    
</body>
</html>