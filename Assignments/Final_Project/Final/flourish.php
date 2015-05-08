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
<!--left container stuff-->
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
	<!-- does the flourish, in this case, a simple CAPTCHA-->
<center>
      <h2>Flourish</h2>

<form action="validate.php" method="post">
  <br>
  <!--makes and prompts the captcha-->
<img src="captcha.php" /><br>
Please Enter The Captcha:<br>
<input name="captcha" type="text"><br><br>
<input name="submit" type="submit" value="Submit">
</form>
<center>
    </div>
  </div>
  <div id="footer">Made by Daniel Bingham, 2015-05-04</div>
</div>
</body>
</html>
