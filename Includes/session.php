<?php
session_start();

$user_check = $_SESSION['logged_user'];

$ses_sql = mysqli_query($dbconnect, "SELECT `Username` FROM `Login` WHERE `Username` = '$user_check'");

$row = mysqli_fetch_array($ses_sql);

$login_session = $row['Username'];

if (isset($_SESSION['logged_user']) == NIL) {
    header("location: login.php");
    die();
}
