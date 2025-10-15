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
  <title>Admin - Ordenes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="admin.php">Almacen ABC</a>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="admin.php">Usuarios</a></li>
        <li class="nav-item"><a class="nav-link" href="admin-prod.php">Productos</a></li>
        <li class="nav-item"><a class="nav-link active" href="admin-ord.php">Ordenes</a></li>
      </ul>
      <span class="navbar-text">
        <?php echo "<a class='nav-link' href='logout.php'>Logout $us</a>"; ?>
      </span>
    </div>
  </div>
</nav>

<div class="container mt-4">
<table class="table">
<thead>
<tr>
  <th>ID</th><th>Nombre Cliente</th><th>Email Cliente</th><th>Total Cuenta</th><th>Fecha</th>
</tr>
</thead>
<tbody>
<?php
$servurl = "http://orders:3003/ordenes";
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
    $nombreCliente = $dec->nombreCliente ?? '';
    $emailCliente = $dec->emailCliente ?? '';
    $totalCuenta = $dec->totalCuenta ?? '';
    $fecha = $dec->fecha ?? '';
    echo "<tr><td>{$id}</td><td>{$nombreCliente}</td><td>{$emailCliente}</td><td>{$totalCuenta}</td><td>{$fecha}</td></tr>";
}
?>
</tbody>
</table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
