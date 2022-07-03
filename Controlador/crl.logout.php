<?php session_start();
// Unset all the session variables
if(!isset($_SESSION['user'])){
    header('Location: ../login.php');
}
$_SESSION = array();
// Destroy the session.
session_destroy();
// Redirect to login page
header('location: ../login.php');
exit;
?>