<?php
$nombre = $_POST["nombre"] ?? '';
$email = $_POST["email"] ?? '';
$usuario = $_POST["usuario"] ?? '';
$pass = $_POST["password"] ?? '';

$url = 'http://users:3001/usuarios';
$data = ['nombre' => $nombre, 'email' => $email, 'usuario' => $usuario, 'password' => $pass];
$json_data = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

header("Location: admin.php");
exit;
?>
