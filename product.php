<!DOCTYPE html>
<html>
    <head>
        <title>Product</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="product.css" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <?php
        include './SQLConnect.php';
        ?>
        <script>function init() {
                printProductData();
            }

            function printProductData() {
                console.log('heir');

                var product = getProductData(text);
                console.log('product: ' + JSON.stringify(product));
                var txt = '', cnt = 0;
                if (product) {
                    for (k in product) {
                        cnt++;
                        if (k != 'foto') {
                            txt += '<p>' + k + ': ' + product[k] + '</p>';
                            if (cnt < Object.keys(product).length) {
                                txt += '<hr>';
                            }
                        } else {
                            document.getElementById('prodImg').src = user[k];
                        }
                    }
                    document.getElementById('text').innerHTML = txt;
                    showComments(product.comments);
                }
            }
            // prodkt vom databas aufrufen
            function getProductData() {
<?php
include './SQLConnect.php';
session_start();
$username = $_GET['user'];
$username = str_replace("'", '', $username);
$product_name = $_GET['pName'];
$product_id = $_GET['pId'];
$product_preis = $_GET['pPreis'];
$product_menge = $_GET['pmenge'];
$product_betrieb = $_GET['pBsystem'];
$product_SpeichPlatz = $_GET['pspeichplatz'];
$product_Akku = $_GET['pAkku'];
$product_kameraaufloesung = $_GET['pkameraaufloesung'];
?>
<?php
/*
 * Produkt bwerten und in Database Speichern
 */

   $rat=0;
   $avg = 0;
if (isset($_POST['stern'])) {
    $rat = $_POST['stern'];

    $query = "insert into product_rating(product_id,username,rating)"
            . "values('" . $_GET['pId'] . "','" . $username . "','" . $rat . "')";
    $resultt = mysqli_query($connect, $query);
    $sql = "SELECT  AVG(rating) FROM product_rating WHERE product_id='$product_id'";
    $result = $connect->query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $avg = $row['AVG(rating)'];
        $avg = round($avg, 1);
        $queree = "UPDATE products SET bewertung = '" . $avg . "' WHERE produkt_id='$product_id' ";
        $userUpdate = mysqli_query($connect, $queree);
        if (!$queree) {
            die("Fehler bei Bearbeitung");
        }
    }
}else {//avg von Datenbamk zu nehmen 
  $sql = "SELECT  * FROM product_rating WHERE username='$username'";
    $result = $connect->query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $avg=$row['rating'];
    }
}
?>
                return {Name: '<?php echo "$product_name" ?>', kameraauflösung: '<?php echo "$product_kameraaufloesung" ?>', Akkukapazitaet: '<?php echo "$product_Akku KW" ?>', Preis: '<?php echo "$product_preis" ?> $', Verfügbar: '<?php echo "$product_menge" ?> ', Betriebssystem: '<?php echo "$product_betrieb" ?> ', SpeichPlatz: '<?php echo "$product_SpeichPlatz GB" ?> '};
            }


            function showMyDataToProduct() {
                console.log('huh');
                var data = getMyDataToProduct();
                //test
                data += {bewertung: 5, anzahlKauefe: 2};
                if (data) {

                    var elems = '<p>Meine Bewertung zum Produkt: ' + <?php echo $rat ?> + '</p><hr>';
                    document.getElementById('extraText').innerHTML = elems;
                }
            }

            /**
             * holen, ob ich das product gekauft habe und ob ich ihn bewertet habe
             */
            function getMyDataToProduct() {

            }


            /**
             * send comment to datenbank
             */
//        function addComment(){
////            console.log(document.getElementById('comment').value)
//
//            //send comment
//
//
//            document.getElementById('comment').value = '';
//        }

            function showComments(comments) {

                if (comments) {
                    var commentsEle = '<p>Kommentare</p>';
                    for (var i = 0; i < comments.length; i++) {
                        commentsEle += '<span>(' + comments[i].user + '): '
                                + comments[i].comment + '</span> <hr>';
                    }
                    console.log('commentsEle: ' + commentsEle);
                    document.getElementById('comments').innerHTML = commentsEle;
                }
            }
        </script>
    </head>
    <body onload='init()' >
        <nav aria-label="breadcrumb" class="main-breadcrumb" style="font-family:verdana;">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item"><a class="navbar-brand" href="startSeite.php?user=<?php echo $_GET['user'] ?> "   style="color: #f8f9fa" ><span class="glyphicon glyphicon-home"  ></span>  Shop</a></li>
            </ol>
        </nav>
        <!-- Breadcrumb -->
<?php
// Kommentare zur Database schicken
if (isset($_POST['addCommentButton'])) {
    $comment = $_POST['comment'];
    $query = "insert into comments(product_id,username,comment)"
            . "values('" . $_GET['pId'] . "','" . $username . "','" . $comment . "')";
    $resultt = mysqli_query($connect, $query);
}
//
?>
        <?php
        $user_name = $_GET['pName'];
        $sql = ("SELECT `produkt_id`, `produkt_name`, `menge`, `produkt_preis`,`bild`,`widths` FROM products Where produkt_name='$user_name'");
        $res_sql = mysqli_query($connect, $sql);
        foreach ($res_sql as $row):
            ?>

            <!-- /Breadcrumb -->

            <div>
                <h1 style="font-family:verdana;">Produkt Infos</h1>
            </div>
            <hr>
            <div id='con' class='container'>
                <div id= 'foto'>
    <?php echo ' <img   style=" width: 250px; padding:5px" src=bilder/' . $row['bild'] . ' alt="Lights" style="width:' . $row['widths'] . '%" >' ?>
                    <label>Bewertung: <?php echo $avg ?></label>
                </div>
                <div id= 'text'>
                    <button>bestellen</button>
                </div>
                <div id="extraText">
                    <script>showMyDataToProduct()</script>
                </div>
                <div>
                    <form action="" method="POST">
                        <div id='addComment' class='container'>
                            <p>Dein Kommentar</p>
                            <input   name='comment' type='text' />
                            <input  type="submit" name="addCommentButton" value="einfügen">
                        </div>
                        <hr>

                        <div id='comments' class='container'>
                            <p>Bewertung</p>
                            <input type="submit" class="clip-star" value="1" name="stern">
                            <input type="submit" class="clip-star" value="2" name="stern">
                            <input type="submit" class="clip-star" value="3" name="stern">
                            <input type="submit" class="clip-star" value="4" name="stern">
                            <input type="submit" class="clip-star" value="5" name="stern">
                        </div>
                    </form>
                </div>
                <div style="color: blue" id='addComment' class='container'>
                    <p>DKommentare</p>
    <?php
    $proId = $_GET['pId'];
    $query = "select * from comments where product_id='$proId'";
    $resultt = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($resultt)) {
        ?>
                        <p><?php echo $row['username'] ?>:</p>
                        <span style="color: black"><?php echo $row['comment'] ?></span>

                        <?php
                    }
                    ?>
                </div></br></br>
                    <?php
                endforeach;
                mysqli_close($connect);
                ?>
        </div>
    </body>
</html>
