<!DOCTYPE html>
<html>
    <head>
        <title>bearbeiten</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="RigesterCSS.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <?php
    // Verbindung mit Datenbank erstellen
    include './SQLConnect.php';
    ?>
    <?php
    /*
     * die Aänderungen in Database aktualisieren
     */
    error_reporting(0);
    $uType = $_GET['uType'];
    $rolleno = $_GET['uID'];
    if (isset($_POST['update'])) {
        $vorName = $_POST['vorname'];
        $nachName = $_POST['nachname'];
        $userName = $_POST['username'];
        $email = $_POST['email'];
        $warenkorb = $_POST['warenkorb'];
        $userType = $_POST['usertype'];
        $queree = "UPDATE users SET vorname = '" . $vorName . "' ,E_Mail = '" . $email . "',nachname = '" . $nachName . "',
              username = '" . $userName . "',usertype = '" . $userType . "'  WHERE user_id='$rolleno'";
        $userUpdate = mysqli_query($connect, $queree);
        header("Refresh:0.5; url=UserAdministration.php");
        if (!$queree) {
            die("Fehler bei Bearbeitung");
        }
    }
    ?>
    <body>
        <form action="" method="POST">
            <h1>Benutzer bearbeiten</h1>
            <p>
                <label>Vorname</label>
                <input  value="<?php echo str_replace(" ","",$_GET['uVorname']) ; ?>" type="text" name="vorname">
            </p>
            <p>
                <label>Nachname</label>
                <input value="<?php echo str_replace(" ","",$_GET['uNachname']) ; ?>" type="text" name="nachname">
            </p>
            <p>
                <label>E_Mail</label>
                <input value="<?php echo str_replace(" ","",$_GET['uEmail']); ?>" type="text" name="email">
            </p>
            <p>
                <label>Username</label>
                <input  value="<?php echo str_replace(" ","",$_GET['uUsername']) ; ?>" type="text" name="username">
            </p>
            <p>
                <label>Usertype</label>
                <input  value="<?php echo str_replace(" ","",$_GET['uType']) ; ?>" type="text" name="usertype">
            </p>
            <p>
                <input type="submit" name="update" value="update speichern" >
            </p>


        </form>
    </body>
