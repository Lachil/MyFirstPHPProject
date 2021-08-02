<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>login</title>
        <link rel="stylesheet" type="text/css" href="RigesterCSS.css">
    </head>
    <body style="text-align: center;   color: white; background-color: white">
        <?php
// Verbindung mit Datenbank erstellen
        include './SQLConnect.php';
        ?>
        <?php
        /*
         *  Überprüfen, ob der Benutzer bereits registriert ist.
         */

        function isRegisted($username, $password) {
            global $connect;
            $quere = "select username,E_Mail,passwort from users";
            $result = mysqli_query($connect, $quere);
            if (!$quere) {
                die("error in quere");
            }
            while ($row = mysqli_fetch_assoc($result)) {
                if ($username === $row['username'] || $username === $row['E_Mail']) {
                    if ($password === $row['passwort']) {
                        return true;
                    }
                }
            }
            return false;
        }
        ?>
        <?PHP
        // Fehlermeidung zeigen falls username oder Passwort falsch ist.
        $fehlermeldung = "";
        /*
         * Benutzer anmelden
         */
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $var = isRegisted($username, $password);
            if ($var) {
                header("Refresh:0.5; url=startSeite.php?user=$username");
            } else {
                $fehlermeldung = "Ihre Passwort oder Username ist falsch";
            }
        }
        ?>


        <form action="" method="POST">
            <h1>Anmelden</h1>
            <p>
                <input placeholder="Username oder E-Mail" type="text" name="username">
            </p>
            <p>
                <input placeholder="Passwort" type="password" name="password">
            </p>
            <p>
                <input type="submit" name="submit" value="anmelden">
                </br>
                <label style="color: red" ><?php echo $fehlermeldung; ?></label>
                </br>
                <label> Wenn Sie Ihre Passwort vergessen haben, kontaktieren Sie bitte uns per E-Mail</label>
            </p>
            <p>
                <label>wenn Sie noch keine Konto haben, klicken Sie bitte </label>
                <a href="rigester.php" class="button--style-red">Hier!</a>
            </p>
        </form>

    </body>
</html>
<?php
// Verbindung mit Datenbank beenden
mysqli_close($connect);
?>
