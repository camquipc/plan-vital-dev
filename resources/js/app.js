import "./bootstrap";

const csrfToken = document.querySelector("[name=csrf-token][content]").content;

function checkedRadio(radio) {
    radio.forEach((el) => {
        el.addEventListener("click", function (e) {
            document.getElementById("selected_ejecutivo").value =
                e.target.value;
            fetch("api_ejecutivos_cargo", {
                method: "POST",
                body: JSON.stringify({ ejecutivo_id: e.target.value }),
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": csrfToken,
                },
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    let cargo = document.querySelector("#cargo");
                    if (data.data.length === 0) {
                        cargo.value = "Sin cargo";
                    } else {
                        cargo.value = data.data[0].id;
                    }
                })
                .catch((err) => console.error(err));
        });
    });
}

document.getElementById("agencia").addEventListener("change", (e) => {
    fetch("api_ejecutivos", {
        method: "POST",
        body: JSON.stringify({ agencia_id: e.target.value }),
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
    })
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            if (data.data.length > 0) {
                let options = `<p>Ejecutivo</p>`;
                for (let i in data.data) {
                    options += `
                <label><input type="radio" name="ejecutivo_id" id="${data.data[i].id}" value="${data.data[i].id}"><span>${data.data[i].nombres}</span></label>
                `;
                }
                document.getElementById("listado").innerHTML = options;
                let radio = document.querySelectorAll(
                    "input[type=radio][name=ejecutivo_id]"
                );
                checkedRadio(radio);
            }
        })
        .catch((err) => console.error(err));
});

document.getElementById("btn_agregar").addEventListener("click", (e) => {
    fetch("api_ejecutivos_tem", {
        method: "POST",
        body: JSON.stringify({
            agencia_id: parseInt(document.getElementById("agencia").value),
            estado: document.getElementById("estado").value,
            cargo_id: parseInt(document.getElementById("cargo").value),
            fecha: document.getElementById("fecha").value,
            ejecutivo_id: parseInt(
                document.getElementById("selected_ejecutivo").value
            ),
            jefatura: document.getElementById("jefatura").value,
        }),
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
    })
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            if (data.data === null) {
                alert("Ejecutivo ya tiene un asistencia para esta fecha.");
            }
            getDataTable(document.getElementById("fecha").value);
            limpiar();
        })
        .catch((err) => console.error(err));
});

function getDataTable(fecha) {
    fetch(`api_ejecutivos_tem/${fecha}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
    })
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            let dat = "";
            for (let i in data.data) {
                dat += `
                     <tr>
                        <td scope="col">${data.data[i].nombres}</td>
                        <td scope="col">${data.data[i].c_nombre}</td>
                        <td scope="col">${data.data[i].jefatura}</td>
                        <td scope="col">${data.data[i].estado}</td>
                        <td scope="col">${data.data[i].a_nombre}</td>
                        <td scope="col">${data.data[i].fecha}</td>
                    </tr>
            `;
            }
            document.getElementById("tbody").innerHTML = dat;
        })
        .catch((err) => console.error(err));
}

function limpiar() {
    //document.getElementById('agencia').value = '';
    document.getElementById("estado").value = "";
    document.getElementById("cargo").value = "";
    //document.getElementById('fecha').value = '';
    document.getElementById("jefatura").value = "";
    document.querySelector(
        "input[type=radio][name=ejecutivo_id]"
    ).checked = false;
}
