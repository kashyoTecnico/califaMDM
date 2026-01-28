function send(cmd) {
    if (!confirm("Enviar comando: " + cmd + " ?")) return;

    fetch("../set_command.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "token=7429&cmd=" + cmd
    })
    .then(r => r.json())
    .then(j => alert("✔ Enviado: " + j.cmd))
    .catch(e => alert("Error"));
}
