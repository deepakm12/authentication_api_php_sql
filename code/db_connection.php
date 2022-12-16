<?php
# Server: Localhost, Database: apratim, User: root, Password:
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "apratim");
// Default Timezone set to Asia/Kolkata
date_default_timezone_set('Asia/Kolkata');

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
  // Database connection failed
  die("Database connection failed with error: " .
    mysqli_connect_error() .
    " (" . mysqli_connect_errno() . ")");
}
