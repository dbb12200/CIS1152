<?php
$header = <<<EOT
<!doctype html>
<html lang="en">
<head>
<metacharset="utf-8">
<title>guestbook</title>
</head>
<body>
EOT;

$footer = <<<EOT
</body>
</html>
EOT;

$guest_form = <<<EOT
<h1> Guest Book</h1>
<form name="guestbook" method="post" action="">
<label>Name: </label>
<input name="name" type="text"><br />
<label>Email: </label>
<input name="email" type="text"><br />
<label>Comment: </label>
<textarea name="comment"></textarea><br />
<input type="submit" name="submit" value="Submit Comment"><br />
</form>
EOT;

echo $header;
echo $guest_form;

$DBServer = 'localhost';
$DBUser = 'root';
$DBPass = '';
$DBName = 'lab9';

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
if($conn->connect_error){
	die('Error: ' . $conn->connect_errno);
}

$results = $conn->query("SELECT name, email, comment, comment_timestamp from lab9;");//fails here

print_r($results);

if(isset($_POST['submit'])){
	$name = "'" . $conn->real_escape_string($_POST['name']) . "'";
	$email = "'" . $conn->real_escape_string($_POST['email']) . "'";
	$comment = "'" . $conn->real_escape_string($_POST['comment']) . "'";
	
	$sql = $conn->query("INSERT INTO guestbook(name, email, comment) VALUES($name, $email, $comment);");
	if($sql === false){
		die('Error: ' . $conn->errno);
	}
	
	while($row = $results->fetch_assoc()) {
		echo $row['name'] . '&nbsp;';
		echo $row['email'] . '&nbsp;';
		echo $row['comment'] . '&nbsp;';
		echo $row['comment_timestamp'] . '&nbsp;<br />';
	}
	
}
else{
	while($row = $results->fetch_assoc()){
		echo $row['name'] . '&nbsp;';
		echo $row['email'] . '&nbsp;';
		echo $row['comment'] . '&nbsp;';
		echo $row['comment_timestamp'] . '&nbsp;<br />';
	}
}
echo $footer;

