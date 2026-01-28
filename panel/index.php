<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CalifaDNS MDM Panel</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>📡 CalifaDNS MDM – Panel</h1>

<div class="grid">

<button onclick="send('ENTER_KIOSK')">🔒 Entrar Kiosk</button>
<button onclick="send('EXIT_KIOSK')">🔓 Salir Kiosk</button>

<button onclick="send('WIFI_LOCK')">📶 WiFi OFF</button>
<button onclick="send('WIFI_UNLOCK')">📶 WiFi ON</button>

<button onclick="send('DNS_LOCK')">🌐 DNS LOCK</button>
<button onclick="send('DNS_UNLOCK')">🌐 DNS UNLOCK</button>

<button onclick="send('STATUSBAR_LOCK')">🔕 Ocultar Barra</button>
<button onclick="send('STATUSBAR_UNLOCK')">🔔 Mostrar Barra</button>

<button onclick="send('FR_LOCK')">🧨 Bloquear Reset</button>
<button onclick="send('FR_UNLOCK')">🧨 Permitir Reset</button>

<button onclick="send('UPDATES_OFF')">⛔ Updates OFF</button>
<button onclick="send('UPDATES_ON')">✅ Updates ON</button>

<button onclick="send('REBOOT')">🔁 Reboot</button>
<button onclick="send('FACTORY_RESET')" class="danger">💀 Factory Reset</button>

</div>

<script src="panel.js"></script>
</body>
</html>
