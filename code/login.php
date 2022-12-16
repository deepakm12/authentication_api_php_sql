<?php
session_start();
extract($_POST);
include("db_connection.php");
$sql = mysqli_query($conn, "SELECT * FROM register where email_id='$email_id'");
if (mysqli_num_rows($sql) == 0) {
    echo "User With email id **", $email_id, "** don't exists. Proceed to register.";
    exit;
} else {
    $row  = mysqli_fetch_array($sql);
    if (is_array($row)) {
        $verify = password_verify($password, $row['password']);
        if (password_verify($password, $row['password'])) {
            // password matches
            $_SESSION["College_Name"] = $row['college_name'];
            $_SESSION["Email_ID"] = $row['email_id'];
            $_SESSION["First_Name"] = $row['first_name'];
            $_SESSION["Last_Name"] = $row['last_name'];
            $d2 = new Datetime("now");
            $session_token = $d2->format('U');
            $session_token = strval($session_token) . strval(session_id());
            $date = date('Y-m-d h:i:s');
            $status = true;
            $query = "INSERT INTO login(email_id, session_token, login_time, status) VALUES ('$email_id', '$session_token','$date', '$status')";
            $sql = mysqli_query($conn, $query) or die("Could Not Perform the Query");
            echo "Login Successfully! <br>- Email ID : ", $email_id, "<br>- Session Token : ", $session_token, "<br>- Login Time : ", $date, "<br>- Status : Active";
        } else {
            echo 'Incorrect Password!';
        }
    }
}
