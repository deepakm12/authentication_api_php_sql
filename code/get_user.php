<?php
extract($_POST);
include("db_connection.php");
$sql = mysqli_query($conn, "SELECT * FROM login where session_token='$session_token'");
$row1  = mysqli_fetch_array($sql);
if (mysqli_num_rows($sql) == 0) {
    echo "Session Token **", $session_token, "** don't exists.";
    exit;
} else {
    if (is_array($row1)) {
        $email_id = $row1['email_id'];
        $intime = $row1['login_time'];
        $outtime = $row1['end_time'];
        $status = $row1['status'];
    }
    $sql2 = mysqli_query($conn, "SELECT * FROM register where email_id='$email_id'") or die("Could Not Perform the Query");
    $row  = mysqli_fetch_array($sql2);
    if (is_array($row)) {
        $namef = $row['first_name'];
        $namel = $row['last_name'];
        $cname = $row['college_name'];
    }
    echo "Session Token **", $session_token, "** details : <br>- First Name : ", $namef, "<br>- Last Name : ", $namel, "<br>- College Name : ", $cname, "<br>- Email ID : ", $email_id;
    if ($status == 1) {
        echo "<br>- Login Time : ", $intime, "<br>- Status : Active";
    } else {
        echo "<br>- Login Time : ", $intime, "<br>- Logout Time : ", $outtime, "<br>- Status : Inactive";
    }
}
