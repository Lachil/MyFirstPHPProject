<?php
//Verbindung mit Datenbank erstellen
include './SQLConnect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Benutzer verwaltung</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="ProfileCss.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?PHP

        /*
         * Benuzer nach Username oder id suchen
         */
        if (isset($_GET['suchenButton'])) {
            $suche = $_GET['suchen'];
            $quere = "select * from users where username='$suche' OR user_id='$suche'";
            $result = mysqli_query($connect, $quere);
            $anzahlGefundeUsers = mysqli_num_rows($result);
            if ($anzahlGefundeUsers == 0) {
                $lableText = 'User nicht gefunden';
            }
        } else {
            /*
             * daten vom Datenbank aufrufen, um sie zu zeigen
             */
            $quere = "select * from users";
            $result = mysqli_query($connect, $quere);
            if (!$quere) {
                die("error in quere");
            }
        }
        ?>
        <?php
        /*
         *  Benutzer löschen
         */
        error_reporting(0);
        $rolleno = $_GET['rn'];
        $query = "DELETE FROM users WHERE user_id='$rolleno'";
        $dat = mysqli_query($connect, $query);
        /*
         * Seite aktualisieren
         */

        function refreshData() {
            header("Refresh:0.5; url=UserAdministration.php");
        }

        if (isset($_GET['re'])) {
            refreshData();
        }
        ?>
        <?php
        /*
         * Benutzer nach id,Vorname,Nachname, Username sortieren
         */
        if (isset($_GET['sortUser'])) {
            $select1 = $_GET['sor'];
            switch ($select1) {
                case 'ID':
                    $sql = "SELECT * FROM users ORDER BY user_id";
                    $result = $connect->query($sql);
                    break;
                case 'Vorname':
                    $sql = "SELECT * FROM users ORDER BY vorname";
                    $result = $connect->query($sql);
                    break;
                case 'Nachname':
                    $sql = "SELECT * FROM users ORDER BY nachname";
                    $result = $connect->query($sql);
                    break;
                default:
                    $sql = "SELECT * FROM users ORDER BY username";
                    $result = $connect->query($sql);
                    break;
            }
        }
        /*
         * Zur addUser Seite wechseln, um neuer User einzufügen
         */
        if (isset($_GET['addUser'])) {
            header('Location: addUser.php');
        }
        ?>
        <!-- Admin Operationen in seite oberteil zeigen -->
        <form id="suchen" action="" method="GET">
          <button>
          <a  name="zurueck" href="Startseite.php?user=<?php echo $_GET['uName'] ?>"  class="navbar-brand"  style="color:black;">shop</a>
        </button>
            <input placeholder="ID oder username angeben" type="text" name="suchen">
            <input type="submit" name="suchenButton" value="suchen" >
            <label>Nutzer einfügen</label>
            <input type="submit" name="addUser" value="einfügen" >
            <label for="sort">sortieren nach:</label>
            <select name="sor" id="sor" >
                <option  value="ID">ID</option>
                <option value="Vorname">Vorname</option>
                <option value="Nachname">Nachname</option>
                <option value="Benutzername">Benutzername</option>
            </select>
            <input type="submit" name="sortUser" value="sort" >
        </form>
        <!-- Benutzertabelle, um alle Benutzer zu zeigen -->
        <form id="tableForm" >
            <label style="color: red; padding: 30px;"><?php echo $lableText; ?></label>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Benutzername</th>
                    <th>E-Mail</th>
                    <th>Type</th>
                    <th>bearbeiten</th>
                    <th>lösche</th>
                </tr>
                <?php
                global $result;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo '' . $row['user_id'] . ''; ?></td>
                        <td><?php echo '' . $row['vorname'] . ''; ?></td>
                        <td><?php echo '' . $row['nachname'] . ''; ?></td>
                        <td><?php echo '' . $row['username'] . ''; ?></td>
                        <td><?php echo '' . $row['E_Mail'] . ''; ?></td>
                        <td><?php echo '' . $row['usertype'] . ''; ?></td>

                        <td><a href="edit.php?uID=<?php echo '' . $row["user_id"] . '' ?>
                               &uVorname=<?php echo '' . $row["vorname"] . '' ?>
                               &uNachname=<?php echo $row["nachname"] ?>
                               &uEmail=<?php echo $row["E_Mail"] ?>
                               &uUsername=<?php echo $row["username"] ?>
                               &uType=<?php echo $row["usertype"] ?>
                               &warenkorb=<?php echo $row["produkt_im_warenkorb"] ?>
                               "><i class="far fa-edit"></i></td>
                        <td><a href="UserAdministration.php?re=true&rn=<?php echo $row["user_id"] ?> ">
                                <i   class="far fa-trash-alt"></i></td>

                    </tr>
                    <?php
                }
                ?>

            </table>
        </form>
    </body>
</html>
