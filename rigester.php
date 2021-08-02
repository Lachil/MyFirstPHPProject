<?php
// Verbindung mit Datenbank erstellen
include './SQLConnect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>users register</title>
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
         * Fehlermeldung Text
         */
        $fehlermeldung = "";
        /*
         * ein neuer Benutzer im Database einfügen
         */
        if (isset($_POST['submit'])) {
            $vorname = $_POST['vorname'];
            $nachname = $_POST['nachname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repeatPassword = $_POST['repeatPassword'];
            $checkUsername = checkUsername($username);

            if ($checkUsername) {
                // überprüfen ,ob der Passwort und der wiederholte Passwort identisch sind
                if ($password == $repeatPassword) {
                    $quere = "insert into users(vorname,nachname,username,E_Mail,passwort)values('" . $vorname . "',"
                            . "'" . $nachname . "','" . $username . "','" . $email . "','" . $password . "')";
                    $result = mysqli_query($connect, $quere);
                    if ($result) {
                        header("Refresh:0.5; url=Login.php");
                    } else {
                        echo 'error in register';
                    }
                } else {
                    $fehlermeldung = "Der Passwort und der wiederholte Passwort sind nicht identisch";
                }
            } else {
                $fehlermeldung = "Bitte ein andere Benutzername auswählen";
            }
        }
        ?>

        <form action="" method="POST">
            <h1>Register</h1>
            <p>
                <input placeholder="Vorname" type="text" name="vorname">
            </p>
            <p>
                <input placeholder="Nachname" type="text" name="nachname">
            </p>
            <p>
                <input placeholder="E-Mail" type="text" name="email">
            </p>
            <p>
                <input  placeholder="Username" type="text" name="username">
            </p>
            <p>
                <input placeholder="Passwort" type="password" name="password">
            </p>
            <p>
                <input placeholder="Passwort wiederholen" type="password" name="repeatPassword"></br>
            </p>
            <p>
                <input type="submit" name="submit" value="registrieren">
            </p>
            <hr>
            <p>
                <label style="color: red;font-size: 20px"><?php echo $fehlermeldung ?></label>
            </p>


        </form>
        <?php
        // Verbindung mit Datenbank beenden
        mysqli_close($connect);
        ?>
    </body>
</html>
