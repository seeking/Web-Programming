<?php

require_once("book.inc.php");
require_once("donation.inc.php");
require_once("user.inc.php");

// connect to the database
@ $db = new mysqli('localhost', 'team05', 'banana', 'team05_cbtb');
if(mysqli_connect_errno())
{
   die("Could not connect to database");
}

// initialize the session
$session_name = "cbtb_team05";
session_name($session_name);
session_start();

// load the user, if set
$USER = null;
if(isset($_SESSION['username']))
{
   // the username
   $username = $_SESSION['username'];

   // load the user
   $USER = User::load($db, $username);
}

?>
