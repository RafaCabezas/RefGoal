/*
    Autor: Rafael Cabezas Aranda
    Proyecto: RefGoal
    Fecha: 14/06/2022
*/

"use strict"

$(() => {
    configForm();
    $("#btnModificar").on("click", modificarAnswer);
    $("#btnCancelar").on("click", cancela);
    cargarTabla();
})

// variables

let idPreg = sessionStorage.getItem("idPregEditarResp");
let botonUpt = "<button type='button' class='edit btn btn-success btn-sm'><i class='bx bx-edit-alt'></i></button>";
let fila, frmDialog;

// funciones

function cargarTabla() {
    let dato = new FormData();
    dato.append("idPreg", idPreg);

    fetch("./php/selectAnswers.php", {
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
                $("tbody").append(`<tr><td>${fila.id_resp}</td> <td>${fila.texto_resp}</td> <td>${fila.correcta}</td> <td>${botonUpt}</td></tr>`);
            });

            // asignar funciones a los botones
            $(".edit").on("click", editReg);

            $('#tableResp').DataTable();
        })
        .catch(function(err) {
            Swal.fire("Error: " + err.status + " " + err.statusText);
        })
}

function editReg() {
    // frmDialog.dialog("option", "title", "Modify answer"); //modificar el título de la ventana
    frmDialog.dialog("open"); //abrir ventana
    fila = $(this).parents("tr"); //extraer la fila del botón

    //pasar los campos de la tabla al formulario
    $("#idAns").prop("readonly", true); //deshabilitar la caja de texto

    $("#idAns").val($(fila).find("td:nth-child(1)").text());
    $("#textoResp").val($(fila).find("td:nth-child(2)").text());
}

function modificarAnswer() {
    let dato = new FormData();
    dato.append("idAnswer", $("#idAns").val());
    dato.append("textoRespuesta", $("#textoResp").val());

    fetch("./php/updateAnswer.php", {
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
            mensaje("Answer modified", "success", "#D5F5E3");
            //pasar los datos del formulario a la fila de actualización
            $(fila).find("td:nth-child(1)").text($("#idQst").val());
            $(fila).find("td:nth-child(2)").text($("#textoPreg").val());

            cancela();
        })
        .catch(error => {
            mensaje("Error: " + error.status, "error", "#FADBD8");
        })
}

function configForm() {
    //configurar la ventana del formulario
    frmDialog = $(".form-horizontal").dialog({
        autoOpen: false,
        height: 320,
        width: 600,
        resizable: false,
        modal: true
    });
}

function cancela() {
    frmDialog.dialog("close");
    $("#idAns").prop("readonly", false);
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