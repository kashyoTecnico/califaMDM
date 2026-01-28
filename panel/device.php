<?php
$device = $_GET["id"] ?? "";
if (!$device) die("Dispositivo inválido");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Dispositivo <?=htmlspecialchars($device)?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <h1>📱 Dispositivo: <?=htmlspecialchars($device)?></h1>
  <a href="index.php">⬅ Volver</a>
</header>

<section class="controls">
  <h2>🎮 Comandos</h2>

  <div class="grid">
    <button onclick="sendCmd('ENTER_KIOSK')">🔒 Entrar KIOSK</button>
    <button onclick="sendCmd('EXIT_KIOSK')">🔓 Salir KIOSK</button>

    <button onclick="sendCmd('WIFI_LOCK')">📶 Bloquear WiFi</button>
    <button onclick="sendCmd('WIFI_UNLOCK')">📶 Desbloquear WiFi</button>

    <button onclick="sendCmd('DNS_LOCK')">🌐 Bloquear DNS</button>
    <button onclick="sendCmd('DNS_UNLOCK')">🌐 Desbloquear DNS</button>

    <button onclick="sendCmd('STATUSBAR_LOCK')">🔕 Ocultar Barra</button>
    <button onclick="sendCmd('STATUSBAR_UNLOCK')">🔔 Mostrar Barra</button>

    <button onclick="sendCmd('UPDATES_OFF')">⛔ Updates OFF</button>
    <button onclick="sendCmd('UPDATES_ON')">✅ Updates ON</button>

    <button onclick="sendCmd('REBOOT')">🔁 Reiniciar</button>
    <button class="danger" onclick="sendCmd('FACTORY_RESET')">💀 Factory Reset</button>
  </div>
</section>

<section class="dns">
  <h2>🌐 DNS Manual</h2>
  <input id="dnsHost" placeholder="dns.example.com">
  <button onclick="setDNS()">Aplicar DNS</button>
</section>

<section class="logs">
  <h2>📜 Logs en vivo</h2>
  <pre id="logbox">Esperando logs...</pre>
</section>

<script>
const DEVICE_ID = "<?=htmlspecialchars($device)?>";
</script>
<script src="panel.js"></script>
</body>
</html>
