<?php

require 'header.php';
include 'config.php';

if (isset($_SESSION['marketing'])) {
  $marketing = $_SESSION['marketing'];
} elseif (isset($_POST['reject'])) {
  $marketing = 'reject';
} elseif (isset($_POST['accept'])) {
  $marketing = 'accept';
} else {
  exit('Cannot access this page directly');
}

$mac = $_SESSION["id"];
$apmac = $_SESSION["ap"];
$last_updated = date("Y-m-d H:i:s");

if ($marketing == 'accept') {
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $email = $_SESSION['email'];
  $phone = $_SESSION['phone'];

  mysqli_query($con, "
    CREATE TABLE IF NOT EXISTS `$table_name` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `firstname` varchar(45) NOT NULL,
    `lastname` varchar(45) NOT NULL,
    `email` varchar(45) NOT NULL,
    `phone` varchar(45) NOT NULL,
    `mac` varchar(45) NOT NULL,
    `last_updated` varchar(45) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY (mac)
    )");

  $stmt = $con->prepare("INSERT INTO `$table_name` (firstname, lastname, email, phone, mac, last_updated) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $fname, $lname, $email, $phone, $mac, $last_updated);
  $stmt->execute();
  $stmt->close();
}
mysqli_close($con);

$controlleruser = $_SERVER['CONTROLLER_USER'];
$controllerpassword = $_SERVER['CONTROLLER_PASSWORD'];
$controllerurl = $_SERVER['CONTROLLER_URL'];
$controllerversion = $_SERVER['CONTROLLER_VERSION'];
$duration = $_SERVER['DURATION'];

$debug = false;

$site_id = $_SERVER['SITE_ID'];

$unifi_connection = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id, $controllerversion);
$set_debug_mode   = $unifi_connection->set_debug($debug);
$loginresults     = $unifi_connection->login();

$auth_result = $unifi_connection->authorize_guest($mac, $duration, null, null, null, $apmac);

?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($business_name); ?> WiFi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="../assets/styles/bulma.min.css" />
    <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css" />
    <meta http-equiv="refresh" content="3;url=https://www.google.com" />
    <link rel="icon" type="image/png" href="../assets/images/favicomatic/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../assets/images/favicomatic/favicon-16x16.png" sizes="16x16" />
    <link rel="stylesheet" href="../assets/styles/style.css" />
</head>

<body>
<div class="page2">

    <div class="head">
        <br>
        <figure id="logo">
            <img src="../assets/images/logo.png">
        </figure>
    </div>

   <div class="main">
       <seection class="section">
           <div id="margin_zero" class="content has-text-centered is-size-6">Thanks, you are now </div>
           <div id="margin_zero" class="content has-text-centered is-size-6">authorized on WiFi</div>
       </seection>
    </div>

</div>
</body>
</html>
