<!DOCTYPE html>
<html>
    <head>
        <title>Benutzerprofile</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="userCSS.css" type="text/css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">



    </head>
    <body >
        <?php
          //bindet die Datei SQLConnect.php
        include './SQLConnect.php';
                error_reporting(0);
          // Variable uName diese wird benötigt , um den ausgewählten User zu berarbeiten
    $uName = $_GET['uName'];
    //Absendebutton wird überprüft
      if (isset($_POST['changePass'])) {
         // Variable vorname
        $neuVorname =  $_REQUEST['vorname'];
         // Variable nachname
        $neuNacname = $_REQUEST['nachname'];
         // Variable newPassword
        $neuPasswort = $_REQUEST['newPassword'];
        // Sql Abfrage um den User im Formular auszugeben
        $sql=("UPDATE users SET vorname = '$neuVorname' , nachname ='$neuNacname',
            passwort = '$neuPasswort'  WHERE username='$uName' ");
                if ($connect->query($sql) === FALSE) {
            echo "Error updating record: " . $connect->error;
          }
                }
                $quere = "select * from users where username='$uName'";
                $result = mysqli_query($connect, $quere);
                 while ($row = mysqli_fetch_assoc($result)) {
                     $vorname=$row['vorname'];
                     $nachname=$row['nachname'];
                     $username=$row['username'];
                     $usertype=$row['usertype'];
                     $email=$row['E_Mail'];
                     $warenkorb=$row['produkt_im_warenkorb'];


                 }



        ?>
        <script>
        //  Das Bearbeiten-Formular anzeigen
            function  getUserData() {
                return {Usertype:"<?php echo $usertype; ?>", Vorname: "<?php echo $vorname; ?>", Nachname: "<?php echo $nachname; ?>",
                    Benutzername: "<?php echo $username; ?>", E_Mail: "<?php echo $email; ?>", Warenkorb: "<?php echo $warenkorb; ?>"};
            }
            function printUserData() {
                var user = getUserData()
                var elems = '';
                var cnt = 0;
                for (k in user) {
                    cnt++;
                    elems += '<p>' + k + ': ' + user[k] + '</p>';
                    if (cnt < Object.keys(user).length) {
                        elems += '<hr>'
                    }
                }
                document.getElementById('text').innerHTML = elems;
            }
            function edit() {
                document.getElementById('edit').style.display = 'block';

            }
        </script>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb bg-dark">
              <!-- Logo und name oben links  -->
                    <li class="breadcrumb-item"><a class="navbar-brand" href="startSeite.php?user=<?php echo $_GET['uName'] ?> "   style="color: #f8f9fa" ><i class="bi bi-house-fill"></i>  Shop</a></li>

            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <div>
            <h1>Userprofile</h1>
        </div>
        <hr>
        <div class='container'>
            <div id= 'foto'>
                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" width="200" alt='Kein Bild vorhanden!'/>
            </div>
            <div id= 'text'>
                <script>
                    printUserData();
                </script>
            </div>
        </div>
        <hr>
        <div class='container'>
            <div >
                <button class="btn-outline-primary" onclick="edit()">Bearbeiten</button>
            </div>
        </div>
        <div id='edit'>
              <hr>
              <div class='container ' >
                  <div >
                      <form   method="post" >
                          <!-- /die Daten abgeben um zu bearbeiten -->
                        neue Vorname:  <input type="text" name="vorname" />
                        neue Nachname: <input type="text" name="nachname" />
                        neue Passwort: <input type="text" name="newPassword" /><br />
                  </div>
              </div>
              <div class='container ' style="border: none">
                  <div >
                    <input class="btn-outline-primary"  type="submit" name="changePass" value="Übernehmen !" />
                          <input class="btn-outline-primary"  type="submit"  id='close' value="Schließen" />
                      </form>
                </div>
            </div>
        </div>
    </body>
</html>
