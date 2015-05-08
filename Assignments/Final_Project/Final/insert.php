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
      <h2>Guestbook</h2>
      <br><br><br>
      <?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "guestbook");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$author = mysqli_real_escape_string($link, $_POST['Author']);
$email = mysqli_real_escape_string($link, $_POST['Email']);
$comment = mysqli_real_escape_string($link, $_POST['Comment']);
 
// attempt insert query execution
$sql = "INSERT INTO guestbook (author, email, comment) VALUES ('$author', '$email', '$comment')";
if(mysqli_query($link, $sql)){
    echo "<h4>Guest Comment Added!</h4><br><br><br><FORM><INPUT value=\"Back to Guestbook\" TYPE=\"button\" onClick=\"parent.location='guestbook.php'\">
</FORM> ";
} else{
    echo "<h4>ERROR: Could not able to execute<h4> $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>
</center>
    </div>
  </div>
  <div id="footer">Made by Daniel Bingham, 2015-05-04</div>
</div>
</body>
</html>
