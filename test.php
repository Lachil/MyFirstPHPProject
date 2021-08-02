<!DOCTYPE html>
<html>
<head>
  <title>DOM Traversal</title>
  <script>
function quadratzahlen(von, bis) {
document.write("<table border=\"1\">");
document.write("<tr><th>x</th><th>x<sup>2</sup></th></tr>");
for(var i = von; i <= bis; i++) {
document.write("<tr><td>" + i + "</td><td>" + i*i + "</td></tr>");
}
document.write("</table>");
}
</script>
</head>
<body>
<input type="button" value="Drück mich" onclick="alert('Danke!')">

</p>
</body>
</html>
