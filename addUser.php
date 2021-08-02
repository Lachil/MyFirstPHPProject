<?php
// Verbindung mit Datenbank erstellen
include './SQLConnect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Benutzer einfügen</title>
        <link rel="stylesheet" type="text/css" href="RigesterCSS.css">
    </head>
    <body style="background-color: white">
        <?php
        /*
         *  Benutzername Überprüfen, ob es bereits exestiert
         */

        function checkUsername($username) {
            global $connect;
            $quere = "select username from users";
            $result = mysqli_query($connect, $quere);
            if (!$quere) {
                die("error in quere");
            }
            while ($row = mysqli_fetch_assoc($result)) {
                if ($username == $row['username']) {
                    return FALSE;
                }
            }
            return TRUE;
        }
        ?>

        <?PHP
        /*
         *  Neuer Benutzer im Database einfügen
         */
        if (isset($_POST['submit'])) {
            $vorname = $_POST['vorname'];
            $nachname = $_POST['nachname'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $usertype = $_POST['usertype'];
            $password = $_POST['password'];
            $checkUsername = checkUsername($username);

            if ($checkUsername) {

                $quere = "insert into users(vorname,nachname,username,usertype,E_Mail,passwort)values('" . $vorname . "',"
                        . "'" . $nachname . "','" . $username . "','" . $usertype . "','" . $email . "','" . $password . "')";
                $result = mysqli_query($connect, $quere);
                header("Refresh:0.5; url=UserAdministration.php");
            } else {
                echo 'please take either username';
            }
        }
        ?>


        <form action="" method="POST">
            <h1>Benutzer einfügen</h1>
            <p>
                <input placeholder="Vorname" type="text" name="vorname">
            </p>
            <p>
                <input placeholder="Nachname" type="text" name="nachname">
            </p>
            <p>
                <input  placeholder="Username" type="text" name="username">
            </p>
            <p>
                <input placeholder="E-Mail" type="text" name="email">
            </p>
            <p>
                <input placeholder="usertype" type="text" name="usertype"></br>
            </p>
            <p>
                <input placeholder="Passwort" type="password" name="password">
            </p>
            <p>
                <input type="submit" name="submit" value="einfügen">
            </p>


        </form>
        <?php
        //Verbindung mit Datenbank beenden
        mysqli_close($connect);
        ?>
    </body>
</html>
