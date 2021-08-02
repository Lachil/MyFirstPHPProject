<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" type="text/css" href="canvas.css"/>
          <?php include 'SQLConnect.php'; ?>
      </head>
      <body>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item"><a href="startSeite.php?user=<?php echo $_GET['uName'] ?>"  style="color :#fff;" >Startseite</a></li>
            </ol>
        </nav>
        <!DOCTYPE html>
              <title>Produkt Menge verkauft </title>
          </head>
          <body>
          <header class="page-header" id="home" style="background: white;">
          <div class="container" style="background: white;">

          <br><center> <h1>Produkt Menge verkauft </h1> </center>

          <canvas id="canvas" width="300" height="300"></canvas>

           <table id="mydata">
              <tbody>
              <tr><th>Handy</th>
                <th>  hersteller</th>
                <th>Menge</th>
                </tr>
            <?php
            $sql = "SELECT * FROM verkaufteproduktemenge ";
          foreach ($connect->query($sql) as $row):
              $id = ($row['produkt_Id']);
               ?>
                <tr>
                  <td><?php echo ($row["produkt_name"]); ?></td>
                  <td><?php echo ($row["menge_verkauft"]); ?></td>
                  </tr>
                <?php endforeach; ?>
            </tbody>
              </table>

              <script>

                  // source data table and canvas tag
          var data_table = document.getElementById('mydata');
          var canvas = document.getElementById('canvas');
          var td_index = 1; // which TD contains the data

          console.log(canvas);


          var tds, data = [], color, colors = [], value = 0, total = 0;
          var trs = data_table.getElementsByTagName('tr'); // all TRs
          for (var i = 0; i < trs.length; i++) {
              tds = trs[i].getElementsByTagName('td'); // all TDs

              if (tds.length === 0) continue; //  no TDs here, move on

              // get the value, update total
              value  = parseFloat(tds[td_index].innerHTML);
              data[data.length] = value;
              total += value;

              // random color
              color = getColor();
              colors[colors.length] = color; // save for later
              trs[i].style.backgroundColor = color; // color this TR
          }


          // get canvas context, determine radius and center
          var ctx = canvas.getContext('2d');
          var canvas_size = [canvas.width, canvas.height];
          var radius = Math.min(canvas_size[0], canvas_size[1]) / 2;
          var center = [canvas_size[0]/2, canvas_size[1]/2];

          console.log(radius)

          var sofar = 0; // keep track of progress
          // loop the data[]
          for (var piece in data) {

              var thisvalue = data[piece] / total;

              ctx.beginPath();
              ctx.moveTo(center[0], center[1]); // center of the pie
              ctx.arc(  // draw next arc
                  center[0],
                  center[1],
                  radius,
                  Math.PI * (- 0.5 + 2 * sofar), // -0.5 sets set the start to be top
                  Math.PI * (- 0.5 + 2 * (sofar + thisvalue)),
                  false
              );

              ctx.lineTo(center[0], center[1]); // line back to the center
              ctx.closePath();
              ctx.fillStyle = colors[piece];    // color
              ctx.fill();

              sofar += thisvalue; // increment progress tracker
          }


              // utility - generates random color
              function getColor() {
                  var rgb = [];
                  for (var i = 0; i < 3; i++) {
                      rgb[i] = Math.round(100 * Math.random() + 155) ; // [155-255] = lighter colors
                  }
                  return 'rgb(' + rgb.join(',') + ')';
              }

              </script>

          </body>
          </html>
        </div>
  </body>
  </html>

</body>
</html>
