<?php
require_once('functions.php');
session_start();
connect_db();

$page="pealeht";

if (isset($_GET['page']) && $_GET['page']!=""){
	$page=htmlspecialchars($_GET['page']);
}

include('views/head.html');

switch($page){
	case "add":
		add();
	break;
	case "view":
		show();
	break;
	default:
		include_once('views/comments.html');
}

include_once('views/foot.html');

?>
