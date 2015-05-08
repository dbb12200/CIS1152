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
<!--Left bar-->
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
<!--script to get guestbook info-->
<form action="insert.php" method="post">
    <p>
		<!--Author field, required-->
        <label for="Author">Author:</label><br>
        <input type="text" name="Author" id="Author" required>
    </p>
    <p>
		<!--Email field, required-->
        <label for="Email">Email:</label><br>
        <input type="email" name="Email" id="Email" required>
    </p>
    <p>
		<!--Comment field, required-->
        <label for="Comment">Comment:</label><br>
        <textarea name='Comment' id='Comment' required></textarea>
    </p>
    <input type="submit" value="Submit">
</form>
<br><br><br><br><br><br>
<!--Store the info-->
<div id="container">
      <table>
        <tbody>
        <?php
            $connect = mysql_connect("localhost","root", "");
            if (!$connect) {
                die(mysql_error());
            }
            mysql_select_db("guestbook");
			//Display the table constants
            echo "<table border='1'>
            <tr>
            <th>Author</th>
            <th>Email</th>
            <th>Comment</th>
            </tr>";
			
			//Display the table values
            $results = mysql_query("SELECT * FROM guestbook LIMIT 100");
            while($row = mysql_fetch_array($results)) {
            echo "<tr>";
            echo "<td>" . $row['Author'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
            echo "<td class='a-table'>" . $row['Comment'] . "</td>";
            echo "</tr>";
            }
            echo "</table>";

?>
            </tbody>
            </table>
          </center>
		</div>
	</div>
	<div id="footer">Made by Daniel Bingham, 2015-05-04</div>
	</div>
</div>
</body>
</html>
