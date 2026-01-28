function loadDevices() {
    fetch("api.php")
        .then(r => r.json())
        .then(data => {
            let html = "";
            const now = Math.floor(Date.now()/1000);

            for (let id in data) {
                let d = data[id];
                let online = (now - d.last_seen) < 15;

                html += `
                <div class="card">
                    <b>${id}</b><br>
                    ${d.model}<br>
                    Estado: ${online ? "🟢 Online" : "🔴 Offline"}<br>
                    Último: ${d.last_result}<br>
                    <a href="device.php?id=${id}">⚙ Gestionar</a>
                </div>`;
            }
            document.getElementById("devices").innerHTML = html;
        });
}

function sendCmd(device, cmd) {
    fetch("../set_command.php", {
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: `token=7429&device=${device}&cmd=${cmd}`
    }).then(()=>alert("Comando enviado"));
}

setInterval(loadDevices, 3000);
loadDevices();
