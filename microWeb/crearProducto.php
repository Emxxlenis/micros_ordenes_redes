<?php
$nombre = $_POST["nombre"] ?? '';
$precio = $_POST["precio"] ?? '';
$inventario = $_POST["inventario"] ?? '';

$url = 'http://products:3002/productos';
$data = ['nombre' => $nombre, 'precio' => $precio, 'inventario' => $inventario];
$json_data = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

header("Location: admin-prod.php");
exit;
?>
