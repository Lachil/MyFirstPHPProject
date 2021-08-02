<!DOCTYPE html>
<html>
    <head>
        <title>Produkte verwaltung</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="ProfileCss.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body >
        <?php
        // Verbindung mit Datenbank erstellen
        include './SQLConnect.php';
        ?>
        <?PHP
        /*
         * Product nach Name oder id suchen
         */
        if (isset($_GET['search'])) {
            $suche = $_GET['suchen'];
            $quere = "select * from products where produkt_name='$suche' OR produkt_id='$suche'";
            $result = mysqli_query($connect, $quere);
            $anzahlGefundeProdukte = mysqli_num_rows($result);
            if ($anzahlGefundeProdukte == 0) {
                $lableText = 'Produkt nicht gefunden';
            }
        } else {
            /*
             * alle Produkte anzeigen
             */
            $quere = "select * from products";
            $result = mysqli_query($connect, $quere);
            if (!$quere) {
                die("error in quere");
            }
        }
        ?>
        <?php
        /*
         * Produkt löschen
         */

        error_reporting(0);
        $p_id = $_GET['pID'];
        $query = "DELETE FROM products WHERE produkt_id='$p_id'";
        $dat = mysqli_query($connect, $query);

        /*
         *  Seite aktualisieren
         */

        function refreshData() {
            header("Refresh:0.5; url=ProductAdministration.php");
        }

        if (isset($_GET['re'])) {
            refreshData();
        }
        ?>
        <?php
        /*
         * Produkte nach id, Preis,Menge,Speicherplatz oder Bewertung sortieren
         */
        if (isset($_GET['sortUser'])) {
            $select1 = $_GET['sor'];
            switch ($select1) {
                case 'ID':
                    $sql = "SELECT * FROM products ORDER BY produkt_id";
                    $result = $connect->query($sql);
                    break;
                case 'Preis':
                    $sql = "SELECT * FROM products ORDER BY produkt_preis";
                    $result = $connect->query($sql);
                    break;
                case 'Menge':
                    $sql = "SELECT * FROM products ORDER BY menge";
                    $result = $connect->query($sql);
                    break;
                case 'Speicherplatz':
                    $sql = "SELECT * FROM products ORDER BY speicherplatz";
                    $result = $connect->query($sql);
                    break;
                default:
                    $sql = "SELECT * FROM products ORDER BY bewertung";
                    $result = $connect->query($sql);
                    break;
            }
        }
        /*
         * zur addProduct Seite wechseln um neues Produkt einzufügen
         */
        if (isset($_GET['addProduct'])) {
            header('Location: addProduct.php');
        }
        ?>
        <!-- Admin Operationen in seite oberteil zeigen -->
        <form id="suchen" action="" method="GET">
          <button>
          <a  name="zurueck" href="Startseite.php?user=<?php echo $_GET['uName'] ?>"  class="navbar-brand"  style="color:black;">shop</a>
        </button>
            <input placeholder="ID oder Name angeben" type="text" name="suchen">
            <input type="submit" name="search" value="suchen" >
            <label>Produkte einfügen</label>
            <input type="submit" name="addProduct" value="einfügen" >
            <label for="sort">sortieren nach:</label>
            <select name="sor" id="sort">
                <option value="ID">ID</option>
                <option value="Preis">Preis</option>
                <option value="Menge">Menge</option>
                <option value="Speicherplatz">Speicherplatz</option>
                <option value="Bewertung">Bewertung</option>
            </select>
            <input type="submit" name="sortUser" value="sort" >
        </form>
        <!-- Produkttabelle um alle Produkte zu zeigen -->
        <form id="tableForm" action="" method="POST">
            <label style="color: red; padding: 30px;"><?php echo $lableText; ?></label>
            <table>
                <tr>
                    <th>Produkt_id</th>
                    <th>Produkt_Name</th>
                    <th>Hersteller</th>
                    <th>Betriebssystem</th>
                    <th>Bieldschirmgröße</th>
                    <th>Speicherplatz</th>
                    <th>Akkukapzität</th>
                    <th>Kameraaüflösung</th>
                    <th>Produkt_Preis</th>
                    <th>Menge</th>
                    <th>Bewertung</th>
                    <th>bearbeiten</th>
                    <th>löschen</th>
                </tr>
                <?php
                global $result;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo '' . $row['produkt_id'] . ''; ?></td>
                        <td><?php echo '' . $row['produkt_name'] . ''; ?></td>
                        <td><?php echo '' . $row['hersteller'] . ''; ?></td>
                        <td><?php echo '' . $row['betriebssystem'] . ''; ?></td>
                        <td><?php echo '' . $row['bildschirmgroesse'] . ''; ?></td>
                        <td><?php echo '' . $row['speicherplatz'] . ''; ?></td>
                        <td><?php echo '' . $row['akkukapazitaet'] . ''; ?></td>
                        <td><?php echo '' . $row['kameraaufloesung'] . ''; ?></td>
                        <td><?php echo '' . $row['produkt_preis'] . ''; ?></td>
                        <td><?php echo '' . $row['menge'] . ''; ?></td>
                        <td><?php echo '' . $row['bewertung'] . ''; ?></td>
                        <td><a href="editProduct.php?pID=<?php echo $row["produkt_id"] ?> &pName=<?php echo $row["produkt_name"] ?>
                               &pHersteller=<?php echo $row["hersteller"] ?>&pPreis=<?php echo $row["produkt_preis"] ?>
                               &pMenge=<?php echo $row["menge"] ?>&pBSystem=<?php echo $row["betriebssystem"] ?>
                               &pBG=<?php echo $row["bildschirmgroesse"] ?>&pSPlatz=<?php echo $row["speicherplatz"] ?>
                               &pAkku=<?php echo $row["akkukapazitaet"] ?>&pKamera=<?php echo $row["kameraaufloesung"] ?>
                               &pBewertung=<?php echo $row["bewertung"] ?>&pBild=<?php echo $row["bild"] ?>
                               "><i class="far fa-edit"></i></td>
                        <td><a href="ProductAdministration.php?re=true&pID=<?php echo $row["produkt_id"] ?> ">
                                <i   class="far fa-trash-alt"></i></td>
                    </tr>
                    <?php
                }
                ?>

            </table>
        </form>
    </body>
</html>
