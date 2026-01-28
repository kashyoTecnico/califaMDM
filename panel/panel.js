function loadDevices() {
  fetch("api.php?action=devices")
    .then(r => r.json())
    .then(d => {
      let html = "";
      for (let id in d) {
        html += `
          <div class="card" onclick="location.href='device.php?id=${id}'">
            <h3>${id}</h3>
            <p>Último contacto: ${new Date(d[id].last_seen*1000).toLocaleTimeString()}</p>
          </div>`;
      }
      document.getElementById("devices").innerHTML = html;
    });
}

function sendCmd(cmd) {
  fetch("api.php", {
    method: "POST",
    headers: {"Content-Type":"application/x-www-form-urlencoded"},
    body: `action=command&token=7429&device=${DEVICE_ID}&cmd=${cmd}`
  }).then(()=>alert("Comando enviado"));
}

function setDNS() {
  const dns = document.getElementById("dnsHost").value;
  fetch("api.php", {
    method:"POST",
    headers:{"Content-Type":"application/x-www-form-urlencoded"},
    body:`action=dns&dns=${encodeURIComponent(dns)}`
  }).then(()=>alert("DNS enviado"));
}

function loadLogs() {
  if (!window.DEVICE_ID) return;
  fetch(`api.php?action=logs&id=${DEVICE_ID}`)
    .then(r=>r.text())
    .then(t=>document.getElementById("logbox").textContent=t);
}

setInterval(loadDevices, 5000);
setInterval(loadLogs, 3000);
loadDevices();
