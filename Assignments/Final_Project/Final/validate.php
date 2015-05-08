<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Alan Turing" />
<meta name="keywords" content="Alan, Turing" />
<meta name="author" content="Daniel Bingham" />
<link rel="stylesheet" type="text/css" href="style.css" media="screen,print" />
<title>Alan Turing: Biography</title>
</head>
<body>
<div id="leftCont"><img class="img2" src="img/LOGO.jpg" alt="Profile" id="logo" />
  <br><br>
  <div id="leftQuote">"We can only see a short distance ahead, but we can see plenty that lies ahead."</div>
  <div id="left_text">
  </div>
</div>
<div id="rightOutside">
<!--nav bar-->
  <div class="navbar" id="nav">
    <ul>
      <li><a href="index.php" title="Welcome">Welcome</a></li>
      <li><a href="biography.php" title="Biography">Biography</a></li>
      <li><a href="guestbook.php" title="Guestbook">Guestbook</a></li>
      <li><a href="flourish.php" title="Flourish">Flourish</a></li>
    </ul>
  </div>
  <div id="navbar_fade"></div>
  <div id="rightInner" class="clearfix">
    <div id="rci_left_column">
<center>
      <h2>Flourish</h2>
<br>
<?php
//Open the connection
session_start();
//Check the captcha
if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"])
{
	//If the right value was entered
	echo "<h4>You have entered the correct code!</h4><br><br><p><h5>CAPTCHA is just a take on the Turing Test. A Turing test is a test to determine whether a machine has intelligence. This test, slightly modified, can be used to verify a machine from a human by asking the user what something it cannot scan a value from is. Commonly, CAPTCHAs use pictures. A human can see what is in the picture, while a computer or any other machine can only see that it is a picture.</h5></p>";
}else{
	//if not the right value
	die("<h4>You have entered an incorrect code. Please try again.</h4><br><br><br><button style=\"height:50px; width:100px\" type=\"button\" onclick=\"history.back();\">Back</button>");
}
?>
</center>
    </div>
  </div>
  <div id="footer">Made by Daniel Bingham, 2015-05-04</div>
</div>
</body>
</html>
