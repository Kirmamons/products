
<?php
header("Content-Type:text/html;charset=UTF-8");

session_start();

require_once "config.php";
require_once "functions.php";

$action = clear_str($_GET['action']);
if(!$action) {
	$action = "main";
}

if(file_exists(ACTIONS.$action.".php")) {
	include ACTIONS.$action.".php";
}
else {
	include ACTIONS."main.php";
}

require_once TIMPLATE."/index.php";
?>