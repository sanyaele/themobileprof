<?php

/*session_start();
// if ($_SERVER['HTTPS']!="on") {
// If(isset($_SERVER['REQUEST_URI']))
//        $redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//        else
//        $redirect= "https://".$_SERVER['HTTP_HOST'];
  //      header("Location:$redirect"); 
//   } 

//$con = mysqli_connect("localhost","astudcom","729ugxKlG7","astudcom_Astud");
$con = mysqli_connect("localhost","root","","astudcom_Astud");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  */
if(isset($_GET['url']))
{
	$first = url_segment(1);
	$second = url_segment(2);
	
if (isset($first) && !isset($second))
{
if ($first == 'home')
{
	include "single.php";
}
if ($first == 'services')
{
	include "single.php";

}
if ($first == 'newsfeed')
{
	include "newsfeed.php";

}
}
else if(isset($second))
{
	if ($first == 'profile')
	{
			include "profile.php";
	}
}
}
else
	include "index.php";
function url_segment($segment){
	if(isset($_GET['url'])){
		$url=$_GET['url'];
		$segment_array=explode('/',$url);
		if(isset($segment_array[$segment-1])){
			return $segment_array[$segment-1];
		}
	}
	
}
?>