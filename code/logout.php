<?php
session_start();
extract($_POST);
include("db_connection.php");
$sql = mysqli_query($conn, "SELECT * FROM login where session_token='$session_token' and status='1'");
if (mysqli_num_rows($sql) == 0) {
    $sql1 = mysqli_query($conn, "SELECT * FROM login where session_token='$session_token'");
    if (mysqli_num_rows($sql1) == 0) {
        echo "Session Token **", $session_token, "** don't exists.";
        exit;
    } else {
        $sql2 = mysqli_query($conn, "SELECT end_time FROM login where session_token='$session_token'");
        echo "Session Token **", $session_token, "** has already been logged out. \nLogout At : ", mysqli_fetch_array($sql2)['end_time'];
        exit;
    }
} else {
    $date = date('Y-m-d h:i:s');
    $status = false;
    $query = "UPDATE login SET status='" . $status . "', end_time='" . $date . "' WHERE session_token='$session_token'";
    $sql = mysqli_query($conn, $query) or die("Could Not Perform the Query");
    echo "Logout Successfully! <br>- Session Token : ", $session_token, "<br>- Logout Time : ", $date, "<br>- Status : Inactive";
    unset($_SESSION["College_Name"]);
    unset($_SESSION["Email_ID"]);
    unset($_SESSION["First_Name"]);
    unset($_SESSION["Last_Name"]);
}
