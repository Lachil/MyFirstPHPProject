<?php
include './SQLConnect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Produkt einfügen</title>
        <link rel="stylesheet" type="text/css" href="RigesterCSS.css">
    </head>
    <body style="background-color: white">
        <?php
        /*
         * Produkt Überprüfen, ob es bereits exestiert
         */

        function checkUsername($productname) {
            global $connect;
            $quere = "select produkt_name from products";
            $result = mysqli_query($connect, $quere);
            if (!$quere) {
                die("error in quere");
            }
            while ($row = mysqli_fetch_assoc($result)) {
                if ($productname == $row['produkt_name']) {
                    return FALSE;
                }
            }
            return TRUE;
        }
        ?>

        <?PHP
        /*
         * ein Neues Produkt im Datbase einfügen
         */
        if (isset($_POST['submit'])) {
            $produktname = $_POST['pName'];
            $produkthersteller = $_POST['pHersteller'];
            $produktpreis = $_POST['pPreis'];
            $produktMenge = $_POST['pMenge'];
            $produktBSystem = $_POST['pBSystem'];
            $produktBG = $_POST['pBG'];
            $produktSpeicherplatz = $_POST['pSpeicherplatz'];
            $produktAkku = $_POST['pAkku'];
            $produktKamera = $_POST['pKamera'];
            $produktFoto = $_POST['pFoto'];
            $produktFWidths = $_POST['pFWidth'];
            $produktBewertung = $_POST['pBewertung'];
            $checkProduktname = checkUsername($produktname);

            if ($checkProduktname) {
                $quere = "insert into products(produkt_name,hersteller,produkt_preis,menge,betriebssystem,"
                        . "bildschirmgroesse,speicherplatz,akkukapazitaet,kameraaufloesung,widths,bild,bewertung)"
                        . "values('" . $produktname . "','" . $produkthersteller . "','" . $produktpreis . "','" . $produktMenge . "',"
                        . "'" . $produktBSystem . "','" . $produktBG . "','" . $produktSpeicherplatz . "','" . $produktAkku . "',"
                        . "'" . $produktKamera . "','" . $produktFWidths . "','" . $produktFoto . "','" . $produktBewertung . "')";
                $result = mysqli_query($connect, $quere);
                header("Refresh:0.5; url=productAdministration.php");
            }
        }
        ?>
        <form id="addProduct" action="" method="POST">
            <h1>Brodukt einfügen</h1>
            <div>
                <p style="width: 300px">
                    <input placeholder="Produktname" type="text" name="pName">
                </p>
                <p>
                    <input placeholder="Hersteller" type="text" name="pHersteller">
                </p>
                <p>
                    <input placeholder="Preis" type="text" name="pPreis">
                </p>
                <p>
                    <input  placeholder="Produktmenge" type="text" name="pMenge">
                </p>
                <p>
                    <input  placeholder="Bildschirmgröße" type="text" name="pBG">
                </p>
                <p>
                    <input  placeholder="Betriebssystem" type="text" name="pBSystem">
                </p>
            </div>
            <div>
                <p style="width: 300px">
                    <input placeholder="Speicherplatz" type="text" name="pSpeicherplatz">
                </p>
                <p>
                    <input placeholder="Akkukapazität" type="text" name="pAkku">
                </p>
                <p>
                    <input placeholder="Kameraauflösung" type="text" name="pKamera">
                </p>
                <p>
                    <input style="color: white"  name="pFoto" type="file" size="50" accept="jpg/*">
                </p>
                <p>
                    <input  placeholder=" Foto Widths" type="text" name="pFWidth">
                </p>
                <p>
                    <input  placeholder="Bewertung" type="text" name="pBewertung">
                </p>
            </div>
            <input style="width: 60%" type="submit" name="submit" value="einfügen">

        </form>
        <?php
        //Verbindung mit Datenbank beenden
        mysqli_close($connect);
        ?>
    </body>
</html>
