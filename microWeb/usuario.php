<?php
session_start();
$us = $_SESSION["usuario"] ?? '';
if ($us == "") {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Usuario</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="usuario.php">Almacen ABC</a>
    <span class="navbar-text">
      <?php echo "<a class='nav-link' href='logout.php'>Logout $us</a>"; ?>
    </span>
  </div>
</nav>

<div class="container mt-4">
<form method="post" action="procesar.php">
<table class="table">
<thead>
<tr>
  <th>Nombre</th><th>Precio</th><th>Inventario</th><th>Cantidad</th>
</tr>
</thead>
<tbody>
<?php
$servurl = "http://products:3002/productos";
$curl = curl_init($servurl);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
if ($response === false) {
    curl_close($curl);
    die("Error en la conexion");
}
curl_close($curl);
$resp = json_decode($response);
$long = is_array($resp) ? count($resp) : 0;
for ($i = 0; $i < $long; $i++) {
    $dec = $resp[$i];
    $id = $dec->id ?? '';
    $nombre = $dec->nombre ?? '';
    $precio = $dec->precio ?? '';
    $inventario = $dec->inventario ?? '';
    echo "<tr><td>{$nombre}</td><td>{$precio}</td><td>{$inventario}</td><td><input type='number' name='cantidad[{$id}]' value='0' min='0'></td></tr>";
}
?>
</tbody>
</table>
<input type="hidden" name="usuario" value="<?php echo htmlspecialchars($us, ENT_QUOTES); ?>">
<input type="submit" value="Agregar a la orden" class="btn btn-primary">
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
