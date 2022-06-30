<?php

require 'header.php';

$_SESSION['fname'] = $_POST['fname'];
$_SESSION['lname'] = $_POST['lname'];
$phone = $_POST['country_code'] . $_POST['phone_number'];
$_SESSION['phone'] = trim($phone);
$_SESSION['email'] = $_POST['email'];

?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>
    <?php echo htmlspecialchars($business_name); ?> WiFi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="../assets/styles/bulma.min.css" />
  <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css" />
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

  <br><br>
    <div class="content is-size-5 is-family-primary has-text-centered has-text-weight-bold">Marketing Preferences</div>

  <figure id="antibot_error" class="image">
    <img src="../assets/images/marketing.png">
  </figure>
    <br>

  <form method="post" action="connect.php">
      <div class="content is-size-6 is-family-primary has-text-centered">Select an option below to get connected:</div>
    <div class="buttons is-centered">
        <div class="field is-grouped">
            <div class="control">
                <button class="button is-danger" name="reject">No thanks</button>
            </div>
            <div class="control">
                <button class="button is-success" name="accept">Accept</button>
            </div>
        </div>
      </div>
    </div>
  </form>
</div>
</body>
</html>
