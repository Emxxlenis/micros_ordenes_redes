<?php
$usuario = $_POST['usuario'] ?? '';
$items = [];

foreach ($_POST['cantidad'] as $id => $cantidad) {
    if ($cantidad > 0) {
        $items[] = ['id' => $id, 'cantidad' => $cantidad];
    }
}

$orden = ['usuario' => $usuario, 'items' => $items];
$json = json_encode($orden);

$url = 'http://orders:3003/ordenes';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

header("Location: usuario.php");
exit;
?>
