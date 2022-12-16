<?php
extract($_POST);
include("db_connection.php");
$sql = mysqli_query($conn, "SELECT * FROM register where email_id='$email_id'");
if (mysqli_num_rows($sql) > 0) {
    echo "User With email id **", $email_id, "** Already Exists.";
    exit;
} else {
    if (!filter_var($email_id, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } else {
        echo "Email don't Exists <br>";
        echo "Register details :  <br>- Email ID : ", $email_id, "<br>- First Name : ", $first_name, "<br>- Last Name : ", $last_name, "<br>- College Name : ", $college_name, "<br>- Password : ", $password;
        $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO register(first_name, last_name, college_name, email_id, password) VALUES ('$first_name', '$last_name','$college_name', '$email_id', '$hashed_pass')";
        $sql = mysqli_query($conn, $query) or die("Could Not Perform the Query");
        echo "<br>Register Successfully! Proceed to Login.";
    }
}
