/*
    Autor: Rafael Cabezas Aranda
    Proyecto: RefGoal
    Fecha: 14/06/2022
*/

"use strict"

$(() => {
    configForm();
    $("#btnModificar").on("click", modificarQuestion);
    $("#btnCancelar").on("click", cancela);
    cargarTabla();
})

// variables

// let session_id = sessionStorage.getItem('idUsuarioLogged');
let session_id = sessionStorage.getItem("idUsuarioLogged");
let btnAns = "<button type='button' id='btnRespuestas' class='btnAns btn btn-dark btn-sm'><i class='bx bx-search'></i></button>";
let botonUpt = "<button type='button' class='edit btn btn-dark btn-sm'><i class='bx bx-edit-alt'></i></button>";
let botonDel = "<button type='button' class='del btn btn-danger btn-sm'><i class='bx bx-message-alt-x'></i></button>";
let fila, frmDialog;
let sessionIdPreg;

// funciones

function cargarTabla() {
    let dato = new FormData();
    dato.append("id_user", session_id);

    fetch("./php/selectQuestions.php", {
            method: "POST",
            body: dato
        })
        .then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                throw response;
            }
        })
        .then(function(data) {
            $("tbody").empty();

            $(data.data).each((index, fila) => {
                // $("tbody").append(`<tr><td>${fila.id_preg}</td> <td>${fila.texto_preg}</td> <td><a href="editAnswer.php">Edit</a></td> <td>${botonUpt}</td> <td>${botonDel}</td></tr>`);

                $("tbody").append(`<tr><td>${fila.id_preg}</td> <td>${fila.texto_preg}</td> <td>${btnAns}</td> <td>${botonUpt}</td> <td>${botonDel}</td></tr>`);
            });

            // asignar funciones a los botones
            $(".btnAns").on("click", editAns);
            $(".edit").on("click", editReg);
            $(".del").on("click", deleteReg);

            $('#tableUsr').DataTable();
        })
        .catch(function(err) {
            Swal.fire("Error: " + err.status + " " + err.statusText);
        })
}

async function editAns() {
    fila = $(this).parents("tr"); //extraer la fila del botón
    console.log(fila);

    sessionIdPreg = $(fila).find("td:nth-child(1)").text();
    sessionStorage.setItem("idPregEditarResp", sessionIdPreg);

    console.log(sessionIdPreg);
    location.href = "editAnswer.php";
}

function editReg() {
    // frmDialog.dialog("option", "title", "Modify question"); //modificar el título de la ventana
    frmDialog.dialog("open"); //abrir ventana
    fila = $(this).parents("tr"); //extraer la fila del botón

    //pasar los campos de la tabla al formulario
    $("#idQst").prop("readonly", true); //deshabilitar la caja de texto

    $("#idQst").val($(fila).find("td:nth-child(1)").text());
    $("#textoPreg").val($(fila).find("td:nth-child(2)").text());
}

function modificarQuestion() {
    let dato = new FormData();
    dato.append("idQstn", $("#idQst").val());
    dato.append("textoPregunta", $("#textoPreg").val());

    fetch("./php/updateQuestion.php", {
            method: "POST",
            body: dato
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw response;
            }
        })
        .then(datos => {
            mensaje("Question modified", "success", "#D5F5E3");
            //pasar los datos del formulario a la fila de actualización
            $(fila).find("td:nth-child(1)").text($("#idQst").val());
            $(fila).find("td:nth-child(2)").text($("#textoPreg").val());

            cancela();
        })
        .catch(error => {
            mensaje("Error: " + error.status, "error", "#FADBD8");
        })
}

async function deleteReg() {
    //extraer la fila donde se ha realizado click del botón eliminar
    fila = $(this).parents("tr");
    console.log(fila);
    Swal.fire({
        title: `Delete the question id=${$(fila).find("td:nth-child(1)").text()}?`,
        text: `There is no turning back`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        focusCancel: true
    }).then(result => {
        if (result.isConfirmed) {
            let dato = new FormData();
            dato.append("idPreguntaBorrar", $(fila).find("td:first").text());

            fetch("./php/deleteQuestion.php", {
                    method: "POST",
                    body: dato
                })
                .then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw response;
                    }
                })
                .then(function(data) {
                    $(fila).remove(); // elimina la fila de la tabla

                    mensaje("Question with its answers deleted", "success", "#D5F5E3");
                })
                .catch(function(err) {
                    Swal.fire("Error: " + err.status + " " + err.statusText);
                })
        }
    })
}

function configForm() {
    //configurar la ventana del formulario
    frmDialog = $(".form-horizontal").dialog({
        autoOpen: false,
        height: 320,
        width: 1000,
        resizable: false,
        modal: true
    });
}

function cancela() {
    frmDialog.dialog("close");
    $("#idQst").prop("readonly", false);
    $(".form-control").val(""); //limpiar cajas de texto
}

let mensaje = (texto, icono, color) => {
    const notificacion = Swal.mixin({
        position: 'top-end',
        toast: true,
        showConfirmButton: false,
        timer: 2500,
        background: color

    });
    notificacion.fire({
        icon: icono,
        title: texto
    })
}