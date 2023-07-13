import "./bootstrap";

const csrfToken = document.querySelector("[name=csrf-token][content]").content;

//manejando los ejecutivos en el radio button
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

//agregar ejecutivo a la lista de posible asistencias
document.getElementById("btn_agregar").addEventListener("click", (e) => {
    let body = {
        agencia_id: parseInt(document.getElementById("agencia").value),
        estado_id: parseInt(document.getElementById("estado").value),
        cargo_id: parseInt(document.getElementById("cargo").value),
        fecha: document.getElementById("fecha").value,
        ejecutivo_id: parseInt(
            document.getElementById("selected_ejecutivo").value
        ),
        jefatura: document.getElementById("jefatura").value,
    };
    fetch("api_ejecutivos_tem", {
        method: "POST",
        body: JSON.stringify(body),
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
    })
        .then((response) => {
            return response.json();
        })
        .then((data) => {

            switch (data.type) {
                case 'data-validacion':
                    alert(data.message);
                    break;
                case 'data-duplicada':
                    alert(data.message);
                    break;

                default:
                    alert(data.message);
                    getDataTable();
                    limpiar();
                    break;
            }

        })
        .catch((err) => console.error(err));
});

function getDataTable() {
    fetch(`api_ejecutivos_tem`, {
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
            if (data.data.length > 0) {
                for (let i in data.data) {
                    let fecha = new Intl.DateTimeFormat('es-CL').format(data.data[i].fecha);
                    dat += `
                         <tr>
                            <td scope="col">${data.data[i].nombres}</td>
                            <td scope="col">${data.data[i].c_nombre}</td>
                            <td scope="col">${data.data[i].jefatura}</td>
                            <td scope="col">${data.data[i].estado}</td>
                            <td scope="col">${data.data[i].a_nombre}</td>
                            <td scope="col">${fecha}</td>
                        </tr>
                `;
                }
                document.getElementById("btn-delete").disabled = false;
                document.getElementById("btn-grabar").disabled = false;
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

//grabar la asistencias
document.getElementById('btn-grabar').addEventListener('click', (e) => {
    let result = confirm('¿Estás seguro de que quieres grabar la data?');
    if (result) {
        fetch(`api_asistencias_store`, {
            method: "POST",
            body: JSON.stringify({
                fecha: document.getElementById('fecha').value
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
                // getDataTable();
                document.getElementById('agencia').value = '';
                document.getElementById("estado").value = "";
                document.getElementById("cargo").value = "";
                document.getElementById('fecha').value = '';
                document.getElementById("jefatura").value = "";
                document.getElementById("selected_ejecutivo").value = null;
                document.getElementById("listado").innerHTML = "";

                document.getElementById("btn-delete").disabled = true;
                document.getElementById("btn-grabar").disabled = true;
                alert('Asistencias guardadas');
            })
            .catch((err) => console.error(err));
    }
})

//eliminar todos los registros
document.getElementById('btn-delete').addEventListener('click', (e) => {
    let result = confirm('¿Estás seguro de que quieres eliminar ?');
    if (result) {
        fetch(`api_ejecutivos_delete`, {
            method: "POST",
            body: JSON.stringify({

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
                getDataTable();
                document.getElementById('agencia').value = '';
                document.getElementById("estado").value = "";
                document.getElementById("cargo").value = "";
                document.getElementById('fecha').value = '';
                document.getElementById("jefatura").value = "";
                document.getElementById("selected_ejecutivo").value = null;
                document.getElementById("listado").innerHTML = "";


            })
            .catch((err) => console.error(err));
    }
})


