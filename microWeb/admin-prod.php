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
  <title>Admin - Productos</title>
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
        <li class="nav-item"><a class="nav-link active" href="admin-prod.php">Productos</a></li>
        <li class="nav-item"><a class="nav-link" href="admin-ord.php">Ordenes</a></li>
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
  <th>ID</th><th>Nombre</th><th>Precio</th><th>Inventario</th>
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
    echo "<tr><td>{$id}</td><td>{$nombre}</td><td>{$precio}</td><td>{$inventario}</td></tr>";
}
?>
</tbody>
</table>

<!-- Modal crear producto -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">CREAR PRODUCTO</button>
<div class="modal" id="exampleModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="crearProducto.php" method="post">
      <div class="modal-header">
        <h5 class="modal-title">CREAR PRODUCTO</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nombre</label><input type="text" name="nombre" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Precio</label><input type="text" name="precio" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Inventario</label><input type="text" name="inventario" class="form-control"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Crear Producto</button>
      </div>
      </form>
    </div>
  </div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
