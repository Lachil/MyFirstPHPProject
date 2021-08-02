<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Webshop</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        include './SQLConnect.php';
        ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Startseite.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <?PHP
        /*
         * daten von Einkaufswagen holen
         */
        global $connect;
        $username = $_GET['uName'];
        $quere = "select
        *
         from
         `einkaufswagen` WHERE user_id='$username' ";
        $result = mysqli_query($connect, $quere);
        ?>
        <?php
        /*
         * Produkte nach Aplle hersteller filtern
         */
        if (isset($_GET['Apple'])) {
            include "produktanzeigen.php";
            echo product("i");
            exit;
        }
        /*
         * Produkte nach Samsung hersteller filtern
         */ else if (isset($_GET['Samsung'])) {
            include "produktanzeigen.php";
            echo product("s");
            exit;
        }
        /*
         * Produkte nach Huawei hersteller filtern
         */ else if (isset($_GET['Huawei'])) {
            include "produktanzeigen.php";
            echo product("h");
            exit;
        }
        /*
         * Produkt im Einkaufswagen suchen
         */ else if (isset($_GET['suche'])) {
            include "produktanzeigen.php";
            echo product($_GET['suche']);
            exit;
        }
        /*
         * Produktdeteills zeigen wenn der Benutzer auf Produktfoto klickt
         */ else if (isset($_GET["Handy"])) {
            include "product.php";
            exit;
        }
        /*
         * Produkt aus dem Einkaufswagen löschen
         */ else if (isset($_POST["remove"])) {
            $Pr_id = $_REQUEST['remove'];
            $quere = "DELETE FROM einkaufswagen
   WHERE produkt_id = '$Pr_id'";
            $res_sql = mysqli_query($connect, $quere);
            ?>
            <meta http-equiv="refresh" content="0">
            <?php
        }
        /*
         * Daten im Database aktualisieren falls ein Produkt verkauft wurde.
         */ else if (isset($_POST["kauf"])) {
            $P_Id = $_POST["kauf"];
            $OID = " SELECT  *  FROM einkaufswagen WHERE produkt_id=$P_Id ";
            $res_sql11 = mysqli_query($connect, $OID);
            while ($row1 = $res_sql11->fetch_assoc()) {
                $anzahlGekauft = $row1['Order_ID'] + 1;
                $quere = "UPDATE `einkaufswagen` SET  `Order_ID`=$anzahlGekauft WHERE produkt_id=$P_Id";
                $res_sql = mysqli_query($connect, $quere);
            }
            $sql1 = " SELECT * FROM `products`  WHERE produkt_id=$P_Id";
            $result = mysqli_query($connect, $sql1);
            while ($row = $result->fetch_assoc()) {
                $AktualisiereMenge = $row['menge'] - 1;
                $produktname = $row['produkt_name'];
                $sql = ("UPDATE `products` SET `menge`= $AktualisiereMenge
    WHERE produkt_id=$P_Id");
                mysqli_query($connect, $sql);
            }
            /*
             * Überprüfen, ob das Produkt bereits im Einkaufswagen eingefügt ist.
             */

            function checkProdukt($productId) {
                global $connect;
                $quere = "select produkt_Id from verkaufteproduktemenge";
                $result = mysqli_query($connect, $quere);
                if (!$quere) {
                    die("error in quere");
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($productId == $row['produkt_Id']) {
                        return FALSE;
                    }
                }
                return TRUE;
            }

            $username = $_GET['uName'];
            $sql12 = " SELECT * FROM `products`  WHERE produkt_id='$P_Id'";
            $result12 = mysqli_query($connect, $sql12);
            $checkproduktid = checkProdukt($P_Id);
            if ($checkproduktid) {
                $sql12 = "INSERT INTO verkaufteproduktemenge (produkt_name,produkt_Id,username,menge_verkauft) VALUES ('$produktname','$P_Id','$username',$anzahlGekauft)";
                $connect->query($sql12);
                $connect->close();
            } else {
                $Mengeverkauft = " SELECT  *  FROM verkaufteproduktemenge WHERE produkt_id='$P_Id' ";
                $res_sql2 = mysqli_query($connect, $Mengeverkauft);
                while ($row2 = $res_sql2->fetch_assoc()) {
                    $AktualisiereMenge = $row2['menge_verkauft'] + 1;
                    $sql12 = "UPDATE verkaufteproduktemenge SET menge_verkauft =$AktualisiereMenge  WHERE  produkt_Id=$P_Id";
                    $connect->query($sql12);
                    $connect->close();
                }
            }
            //while ($row2 = $result12->fetch_assoc()) {
            //$produktname=$row2['produkt_name'];
            //$Pr_Id=$row2['produkt_id'];
            ?>
            <div class="alert alert-success">
                <strong>Guten Tag!</strong>vielen Dank für Ihre Bestellung. Wir werden Sie benachrichtigen, sobald Ihr(e) Artikel versandt wurde(n). Sie finden das voraussichtliche Lieferdatum in e-mail .
            </div>
            <meta http-equiv="refresh" content="2">

            <?php
        }
        ?>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand"  href="startSeite.php?user=<?php echo $_GET['uName'] ?>"><span class="glyphicon glyphicon-home"></span>  Shop</a>
                </div>
                <form class="navbar-form navbar-left"  >
                    <form action="Produktanzeige.php?user=fr" method="get">
                        <div class="form-group">
                            <input type="text" class="form-control"   name="suche" />
                        </div>
                        <button type="submit" class="form-control" name="anzeigen" id="submit" value=" <?php echo $_GET['user'] ?>"><i class="fas fa-search"></i> Suchen </button>

                        <div class="btn-group">
                            <button type="submit" name="Apple" class="btn btn-light" value=" <?php echo $_GET['uName'] ?>"  >Apple</button>
                            <button type="submit" name="Samsung" class="btn btn-light"  value=" <?php echo $_GET['uName'] ?>">Samsung</button>
                            <div class="btn-group">
                                <button type="submit" name="Huawei" class="btn btn-light"   value=" <?php echo $_GET['uName'] ?>">   Huawei  </button>
                            </div>
                        </div>
                    </form>
                    <form action="" method="get">
                        <ul class="nav navbar-nav navbar-right">
<?php
$user_name = $_GET['uName'];
$user_typ = "select  *    from   `users` WHERE username='$user_name'";
$res_sql = mysqli_query($connect, $user_typ);
//  $result_users= mysqli_query($connect, $user_typ);
//$user_angemeldt=$_GET['re'];
?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_GET['uName'] ?></a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"><div class="list-group">
                            <?php
                            while ($row1 = mysqli_fetch_assoc($res_sql)) {
                                if ($row1['usertype'] == "admin") {
                                    ?>
                                                    <a href="userProfile.php?uName=<?php echo $_GET['user'] ?> " class="list-group-item list-group-item-action">meine Profil</a>
                                                    <a href="ProductAdministration.php" class="list-group-item list-group-item-action">produkteverwaltung</a>
                                                    <a href="UserAdministration.php" class="list-group-item list-group-item-action">Benutzerverwaltung</a>
                                                    <?php
                                                    break;
                                                    ?>
                                                    <a href="userProfile.php?uName=<?php echo $_GET['user'] ?> " class="list-group-item list-group-item-action">meine Profil</a>
                                                    <a href="#" class="list-group-item list-group-item-action">Warenkorp</a><?php
                                            break;
                                        }
                                    }
                                            ?>
                                            <a href="startSeite.php?user=" "" class="list-group-item list-group-item-action">Abmelden</a>
                                        </div></a>

                                    </form>
                                </div>
                                </nav>

                                <div class="container">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Bild</th>
                                                <th scope="col">Produkt name</th>
                                                <th scope="col">Menge in Lage</th>
                                                <th scope="col">gekauft</th>
                                                <th scope="col">kaufen</th>
                                                <th scope="col">löschen</th>
                                            </tr>
                                        </thead>

                                        <tbody>
<?php
//$user=$_GET['uName'];
while ($row = mysqli_fetch_assoc($result)) {
    $Id = $row['produkt_id'];
    $order_id = $row['Order_ID'];
    $queree = "select
          *
           from
           `products` WHERE produkt_id='$Id' ";
    $result_products = mysqli_query($connect, $queree);
    while ($row1 = mysqli_fetch_assoc($result_products)) {
        ?>
                                                    <tr>
                                                        <th scope="row"><?php echo '<img  src=bilder/' . $row1['bild'] . ' class="img-thumbnail" alt="Cinque Terre"  name=' . $row1['produkt_name'] . ' style="  height: 150px;
          width: 100px;"> ' ?></th>
                                                        <th scope="row"><?php echo '' . $row1['produkt_name'] . ''; ?></th>
                                                        <th scope="row"><?php echo '' . $row1['menge'] . ''; ?></th>
                                                        <th scope="row"><?php if ($order_id != '0') {
            ?>
                                                                <span class="glyphicon glyphicon-check"></span>
                                                            <?php } ?></th>
                                                        <th scope="row">  <form   method="post"><?php echo ' <button type="submit"  class="btn" name="kauf" value=' . $row['produkt_id'] . ' ><i class="fas fa-shopping-cart"> kaufen </i></button>' ?></th>
                                                        <th scope="row">
        <?php echo '
          <button type="submit"  class="btn"   name="remove" value=' . $row['produkt_id'] . ' ><span class="glyphicon glyphicon-trash"></span> löschen </button>
          </form> ' ?></th>
                                                    </tr>
                                                            <?php
                                                            break;
                                                        }
                                                        ?>
                                                        <?php
                                                    }
                                                    ?>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="footer">
                                    <!-- Footer -->
                                    <footer class="text-center text-lg-start bg-light text-muted">
                                        <!-- Section: Social media -->
                                        <section
                                            class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
                                            >
                                        </section>
                                        <!-- Section: Social media -->

                                        <!-- Section: Links  -->
                                        <section class="">
                                            <div class="container">
                                                <!-- Grid row -->
                                                <div class="row mt-3">
                                                    <!-- Grid column -->
                                                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                                                        <!-- Content -->
                                                        <h6 class="text-uppercase fw-bold mb-4">
                                                            <i class="fas fa-gem me-3"></i>Handy_Shop
                                                        </h6>
                                                        <p>
                                                            Diese Web-Shop ist im Rahmen eine Uni-Test für den Modul Web- und Multimedia implementiert werden.
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mb-4">
                                                        <!-- Links -->
                                                        <h6 class="text-uppercase fw-bold mb-4">
                                                            Contact
                                                        </h6>
                                                        <p><i class="fas fa-home me-3"></i> Huchschule Ruhr West </p>
                                                        <p>
                                                            <span class="glyphicon glyphicon-user"></span> Lhabib Lachil ,Ahmed Mohamed,Ulugbek
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- Grid row -->
                                            </div>
                                        </section>
                                    </footer>
                                    <!-- Footer -->
                                </div>
                                </body>
                                </html>
