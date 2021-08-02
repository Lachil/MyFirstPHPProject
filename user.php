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
        <link rel="stylesheet" href="user.css" type="text/css">
        <script src="user.js"></script>
        <?php
        include './SQLConnect.php';
        ?>
        <style>
        </style>
      <script>function init(){
          console.log('init')
          document.getElementById('changeForm').addEventListener('submit', handleForm);
          document.getElementById('changePass').addEventListener('click', changePass);
          document.getElementById("close").addEventListener('click', close);
      }

      function handleForm(event) { event.preventDefault(); }

      function printUserData(){
          var user = getUserData()
          console.log('helloworld');
          var elems = '';
          var cnt = 0;
          for(k in user){
              cnt++;
              elems += '<p>'+ k +': '+ user[k] +'</p>';
              if(cnt < Object.keys(user).length){
                  elems += '<hr>'
              }
          }
          document.getElementById('text').innerHTML = elems;
      }

      /**
       * get benutzer from datenbank
       * @returns
       */
      function  getUserData(){
          return {Name: 'Ulugbek', Vorname: 'Hudaybergenov', ID: '1', Benutzername: 'Ulugbeck', Kennwort: 'Ulugbeck',  Erstellungsdatum: '14.06.2021'};
      }

      function edit(){
          console.log('edit')
          document.getElementById('edit').style.display = 'block';

      }


      function changePass(){
          console.log('change pass')
          var newPass = document.getElementById('newPassword').value;
          /**
           * send to datenbank
          */
          document.getElementById('newPassword').value = '';
      }

      function close(){
          console.log('close')
          document.getElementById('edit').style.display = 'none';
      }
</script>
    </head>
    <body>
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item"><a href="index.html">Startseite</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
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
            <div class='container '>
                <div >
                    <form id='changeForm'>
                        <input class="btn-outline-primary" id='newPassword' type='text' />
                        <button class="btn-outline-primary" id='changePass' >Übernehmen</button>
                        <button class="btn-outline-primary" id='close'>Schließen</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
