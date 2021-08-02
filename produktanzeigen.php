<!DOCTYPE html>
<html lang="de">
<head>
  <title>Webshop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
  include './SQLConnect.php';
  ?>
  <?PHP
// Sql Abfrage um die Produkte auszugeben
        global $connect;
        $quere = "select
        *
         from
         `products`";
         // Sql Abfrage für die Produktausgabe
        $result = mysqli_query($connect, $quere);
?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="Startseite.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php

if(isset($_GET['anzeigen'])){
  $name=$_GET['anzeigen'];
  $name=str_replace(" ","",$name);
  } elseif (isset($_GET['Apple'])){
    $name=$_GET['Apple'];
    $name=str_replace(" ","",$name);
  }elseif  (isset($_GET['Samsung'])){
    $name=$_GET['Samsung'];
    $name=str_replace(" ","",$name);
  }else{
    $name=$_GET['Huawei'];
    $name=str_replace(" ","",$name);
  } ?>
<?php
 if(isset($_POST["kauf"])){
  $Pr_id=$_REQUEST['kauf'];
  $orderId=0;
  $quere ="INSERT INTO einkaufswagen (Order_ID,user_id,produkt_id,Order_Date) VALUES ('$orderId','$name','$Pr_id','GETDATE()')";
  $res_sql = mysqli_query($connect, $quere);
  }
?>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="startSeite.php?user=<?php echo $name ?>"><i class="fas fa-mobile-alt"></i>  Shop</a>
    </div>
    <form class="navbar-form navbar-left" action="Startseite.php">
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo  $name ?></a></li>
    </ul>
  </div>
</nav>
<style>

</style>
<div class="container" >
  <?php function product($text)
  {
   include './SQLConnect.php';
   session_start();
        $sql = ("SELECT * FROM products Where produkt_name LIKE  '".$text."%'");
      // Sql Abfrage ausführen
      $res_sql = mysqli_query($connect, $sql);

     // Anzahl der gefunden Produkte ermitteln
     $anzahlGefundeProdukte = mysqli_num_rows($res_sql);

      //falls kein Produkt gefunden worden ist
     if($anzahlGefundeProdukte==0){
         echo "<h1> Produkt nicht gefunden </h1>";
     }
      //falls ein Produkt gefunden worden ist
     if($anzahlGefundeProdukte>0){

       while ($row = mysqli_fetch_assoc($res_sql)) {?>
       <!-- Container für Produkte  -->
       <div class="col-md-5">
         <form action="" method="get" >
             <div class="center">
           <a name="Handys" href="product.php?re=true&pName=<?php echo $row['produkt_name'] ?> &pId=<?php echo $row['produkt_id'] ?> &pmenge=<?php echo $row['menge'] ?> &pPreis=<?php echo $row['produkt_preis'] ?> &pkameraaufloesung=<?php echo $row['kameraaufloesung'] ?> &user=<?php echo $row['betriebssystem'] ?> &pAkku=<?php echo $row['akkukapazitaet'] ?>  &pBsystem=<?php echo $row['betriebssystem'] ?> &pspeichplatz=<?php echo $row['speicherplatz'] ?> ">
           <?php echo  ' <img  src=bilder/'.$row['bild'].' alt="Lights"  name='.$row['produkt_name'].' style="width:'.$row['widths'].'%"> '?>
         </form>
           <div class="caption">
            <?php echo '<h4>'.$row['produkt_name'].'</h4>'?>
           </div>
           </a>
     <form>
         <h5>Verfügbarer Menge : <span class="label label-default"><?php echo $row["menge"] ?></span></h5>
     </form>
     <?php echo'<p> '.$row['produkt_preis'].' €</p>'?>
     <?php echo '  <form method="post">
     <button type="submit"  class="btn"  name="kauf" value='.$row['produkt_id'].' ><i class="fas fa-shopping-cart">  Warenkorp einfügen </i></button>
     </form> ' ?>
</div>
</div>
             <?php
           }

}   }
mysqli_close($connect);
?>
   </div>
</body>
</html>
