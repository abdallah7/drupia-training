<?php
session_start();
include 'data.php';
$book = new Book();
$action = $book->connect();

$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = $action->real_escape_string($myusername); 
$mypassword = $action->real_escape_string($mypassword);

$result = $action->query("SELECT * FROM `users` WHERE username='$myusername' and password='$mypassword'");

$count = $result->num_rows;

if($count==1){
$userdata = array();
foreach ($result as $userdata) {
//$userdata = $result ;
$_SESSION['user_id']	= $userdata['user_id'];
$_SESSION['username']   = $userdata['username'];
$_SESSION['type']       = $userdata['type'];

}
header("location:form.php");
}
else {
echo "Wrong Username or Password";
}
?>
<!-- $userdata = $this->usersModel-> getUserInfo();
// in your login check set this two session variables for destroy session after 15 min
$_SESSION['username']   = $userdata['username'];
$_SESSION['last_login_timestamp'] = time(); -->