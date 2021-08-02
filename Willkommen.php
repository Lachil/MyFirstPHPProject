<!DOCTYPE html>
<html lang="en">
<head>
  <title> Handy Shop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1><span class="glyphicon glyphicon-phone"></span>Handy Shop</h1>
</div>
<?php
/*
 *  Willckommen Seite wird der Benutzer nach 2 Skunden automatusch zu startSeit weitergeleitet
 */
session_start();
header("Refresh:2; url=startSeite.php?user= ");
?>
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h3>Lhabib Lachil</h3>
      <p>10011909</p>
    </div>
    <div class="col-sm-4">
      <h3>Ulugbek Hudaybergenov</h3>
      <p>10012502</p>
    </div>
    <div class="col-sm-4">
      <h3>Mohamed Ahmad</h3>
      <p>10008834</p>
    </div>
  </div>
</div>

</body>
</html>
