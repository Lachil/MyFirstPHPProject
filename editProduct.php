<!DOCTYPE html>
<html>
    <head>
        <title>Produkte bearbeiten</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="RigesterCSS.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <?php
    //  Verbindung mit Datenbank erstellen
    include './SQLConnect.php';
    ?>
    <?php
    /*
     *    Änderungen im Datenbase aktualisieren
     */
    error_reporting(0);
    $pID = $_GET['pID'];
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $hersteller = $_POST['hersteller'];
        $preis = $_POST['preis'];
        $menge = $_POST['menge'];
        $bildsize = $_POST['bildsize'];
        $betriebssystem = $_POST['betriebssystem'];
        $speicherplatz = $_POST['SPlatz'];
        $akku = $_POST['akku'];
        $kamera = $_POST['kamera'];
        $bild = $_POST['bild'];
        $bewertung = $_POST['bewertung'];
        $queree = "UPDATE products SET produkt_name = '" . $name . "' ,hersteller = '" . $hersteller . "',produkt_preis = '" . $preis . "',
              menge = '" . $menge . "',bildschirmgroesse = '" . $bildsize . "',betriebssystem = '" . $betriebssystem . "'"
                . ",speicherplatz = '" . $speicherplatz . "',akkukapazitaet = '" . $akku . "',kameraaufloesung = '" . $kamera . "'"
                . ",bild = '" . $bild . "',bewertung = '" . $bewertung . "'  WHERE produkt_id='$pID'";
        $userUpdate = mysqli_query($connect, $queree);
        if (!$queree) {
            die("Fehler bei Bearbeitung");
        }
    }
    ?>
    <body>
        <?php
        /*
         *  Zur productAdministration Seite zurückkehren
         */

        function refreshData() {
            header("Refresh:0.5; url=productAdministration.php");
        }

        if (array_key_exists('submit', $_POST)) {
            refreshData();
        }
        ?>
        <form id="addProduct" action="" method="POST">
            <h1>Produkt bearbeiten</h1>
            <div id="editDiv">
                <p style="width: 300px " >
                    <label>Name</label>
                    <input  value="<?php echo str_replace(" ", "", $_GET['pName']) ?>" type="text" name="name">
                </p>
                <p>
                    <label>Hersteller</label>
                    <input  value="<?php echo str_replace(" ", "", $_GET['pHersteller']) ?>" type="text" name="hersteller">
                </p>
                <p>
                    <label>Preis</label>
                    <input  value="<?php echo str_replace(" ", "", $_GET['pPreis']) ?>" type="text" name="preis">
                </p>
                <p>
                    <label>Menge</label>
                    <input  value="<?php echo str_replace(" ", "", $_GET['pMenge']) ?>" type="text" name="menge">
                </p>
                <p>
                    <label>Bild G</label>
                    <input  value="<?php echo str_replace(" ", "", $_GET['pBG']) ?>" type="text" name="bildsize">
                </p>
                <p>
                    <label>BSystem</label>
                    <input  value="<?php echo str_replace(" ", "", $_GET['pBSystem']) ?>" type="text" name="betriebssystem">
                </p>
            </div>
            <div id="editDiv">
                <p style="width: 300px">
                    <label>SPlatz</label>
                    <input  value="<?php echo str_replace(" ", "", $_GET['pSPlatz']) ?>" type="text" name="SPlatz">
                </p>
                <p>
                    <label>Akku</label>
                    <input  value="<?php echo str_replace(" ", "", $_GET['pAkku']) ?>" type="text" name="akku">
                </p>
                <p>
                    <label>Kamera</label>
                    <input  value="<?php echo str_replace(" ", "", $_GET['pKamera']) ?>" type="text" name="productcount">
                </p>
                <p>
                    <label>Bild</label>
                    <input  value="<?php echo str_replace(" ", "", $_GET['pBild']) ?>" type="text" name="bild">
                </p>
                <p>
                    <label>Kamera</label>
                    <input  value="<?php echo str_replace(" ", "", $_GET['pKamera']) ?>" type="text" name="kamera">
                </p>
                <p>
                    <label>Bewertung</label>
                    <input  value="<?php echo str_replace(" ", "", $_GET['pBewertung']) ?>" type="text" name="bewertung">
                </p>
            </div>
            <input style="width: 60%" type="submit" name="submit" value="Änderung Speicheren">

        </form>
    </body>
