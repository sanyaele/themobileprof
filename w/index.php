<?php
require_once ('../includes/common.php');

if (empty($_GET['a'])){
    header("HTTP/1.0 403 Forbidden");
    die("You are not allowed to access this file");
} else {
    $a = addslash($_GET['a']);
}

if (!empty($_GET['c'])){
    $c = "&coupon=".addslash($_GET['c']);
} else {
    $c = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-7718160-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-7718160-1');
    </script>
    <meta http-equiv="refresh" content="2; url=<?php echo "https://www.seonigeria.com/mobile-professional-whatsapp.php?ref=".$a.$c; ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loading...</title>
</head>
<body>
    Loading...
</body>
</html>