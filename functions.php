<?php
function connect_db(){
	global $connection;
	$host="localhost";
	$user="test";
	$pass="t3st3r123";
	$db="test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("mootoriga ei saanud ühendust luua- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}

function add(){
	global $connection;
	
	if ($_SERVER['REQUEST_METHOD']=='GET'){
		include_once('views/newcomment.html');
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {		
		if (isset($_POST['Comment'])) {  
			$comment = mysqli_real_escape_string($connection, $_POST['Comment']);
		} else {
			$errors[]= "Märkus on puudu!";
		}
		if (empty($errors)) {
			$query = "INSERT INTO atambek_eksam_comments (ID, Comment) VALUES ('0','$comment')";
			$result = mysqli_query($connection, $query);
			if (mysqli_insert_id($connection) == 0) {
				$errors[]= "Märkuse lisamine ebaõnnestus!";
			}	
		}
	}
	show();
}

function show(){
	global $connection;
	$query ="SELECT * FROM atambek_eksam_comments";
	$result = mysqli_query($connection, $query) or die("$query - ".mysqli_error($connection));
	$comments = array();
	while ($comment=mysqli_fetch_assoc($result)) {
			$comments[$comment['ID']]=$comment;
	}
	//header("Location: ?page=show");
	include_once('views/comments.html');
}