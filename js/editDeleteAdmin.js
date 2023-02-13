/*
    Autor: Rafael Cabezas Aranda
    Proyecto: RefGoal
    Fecha: 14/06/2022
*/

"use strict"

$(() => {
    configForm();
    $("#btnModificar").on("click", modificarAdmin);
    $("#btnCancelar").on("click", cancela);
    cargarTabla();
})

// variables
let fila, frmDialog;
let botonesUptDel = "<button type='button' class='edit btn btn-dark m-2'><i class='fas fa-edit'></i></button><button type='button' class='del btn btn-danger'><i class='fas fa-trash-alt'></i></button>";

// funciones

function cargarTabla() {
    fetch("./php/selectUsuarios.php", {
            method: "POST"
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
                $("tbody").append(`<tr><td>${fila.id_usr}</td><td>${fila.nombre_usr}</td><td>${fila.correo}</td><td>${botonesUptDel}</td></tr>`);
            });

            // asignar funciones a los botones
            $(".edit").on("click", editReg);
            $(".del").on("click", borrarRegistro);

            $('#tableAdmins').DataTable();
        })
        .catch(function(err) {
            Swal.fire("Error: " + err.status + " " + err.statusText);
        })
}

function editReg() {
    // frmDialog.dialog("option", "title", "Modify user"); //modificar el título de la ventana
    frmDialog.dialog("open"); //abrir ventana
    fila = $(this).parents("tr"); //extraer la fila del botón

    //pasar los campos de la tabla al formulario
    $("#idAd").prop("readonly", true); //deshabilitar la caja de texto

    $("#idAd").val($(fila).find("td:nth-child(1)").text());
    $("#nombre").val($(fila).find("td:nth-child(2)").text());
    $("#mail").val($(fila).find("td:nth-child(3)").text());
}

function modificarAdmin() {
    // let parametros = $(".form-horizontal").serialize();
    // console.log(parametros);
    let dato = new FormData();
    dato.append("idAdmin", $("#idAd").val());
    dato.append("nombreAdmin", $("#nombre").val());
    dato.append("mailAdmin", $("#mail").val());

    fetch("./php/editarUsuario.php", {
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
            mensaje("Admin modified", "success", "#D5F5E3");
            //pasar los datos del formulario a la fila de actualización
            $(fila).find("td:nth-child(1)").text($("#idAd").val());
            $(fila).find("td:nth-child(2)").text($("#nombre").val());
            $(fila).find("td:nth-child(3)").text($("#mail").val());
            cancela();
        })
        .catch(error => {
            mensaje("Error: " + error.status, "error", "#FADBD8");
        })
}

// function editarRegistro() {
//     frmDialog.dialog("option", "title", "Modificar administrador"); //modificar el título de la ventana
//     frmDialog.dialog("open"); //abrir ventana
//     fila = $(this).parents("tr"); //extraer la fila del botón click

//     //pasar los campos de la tabla al formulario
//     $("#idAd").prop("readonly", true); //deshabilitar la caja de texto para que no pueda editarla
//     $("#idAd").val($(fila).find("td:nth-child(1)").text());
//     $("#nombre").val($(fila).find("td:nth-child(2)").text());
//     $("#mail").val($(fila).find("td:nth-child(3)").text());

//     // editar datos del administrador
//     let parametros = $(".form-horizontal").serialize();
//     console.log(parametros);

//     fetch("./php/editarUsuario.php", {
//             method: "POST",
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded'
//             },
//             body: parametros
//         })
//         .then(response => {
//             if (response.ok) {
//                 return response.json();
//             } else {
//                 throw response;
//             }
//         })
//         .then(datos => {
//             mensaje("Administrador editado", "success", "#D5F5E3");

//             //pasar los datos del formulario a la fila de actualización
//             $(fila).find("td:nth-child(1)").text($("#idAd").val());
//             $(fila).find("td:nth-child(2)").text($("#nombre").val());
//             $(fila).find("td:nth-child(3)").text($("#mail").val());

//             // cancela(); // cierra la ventana

//             // Swal.fire({
//             //     position: 'top-end',
//             //     icon: 'success',
//             //     title: '',
//             //     showConfirmButton: false,
//             //     timer: 2500
//             // })
//         })
//         .catch(function(err) {
//             mesaje("Error" + err.status, "error", "#FADBD8");
//         })
// }

function borrarRegistro() {
    //extraer la fila donde se ha realizado click del botón eliminar
    fila = $(this).parents("tr");
    console.log(fila);
    Swal.fire({
        title: `Delete ${$(fila).find("td:nth-child(2)").text()}?`,
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
            dato.append("idUsuario", $(fila).find("td:first").text());

            fetch("./php/eliminarUsuario.php", {
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

                    mensaje("Admin deleted", "success", "#D5F5E3");
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
        height: 400,
        width: 400,
        resizable: false,
        modal: true
    });
}

function cancela() {
    frmDialog.dialog("close");
    $("#idAd").prop("readonly", false);
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