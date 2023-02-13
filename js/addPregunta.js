/*
    Autor: Rafael Cabezas Aranda
    Proyecto: RefGoal
    Fecha: 14/06/2022
*/

"use strict"

$(() => {
    ocultarDivRespuestas();
    $("#addPreg").on("click", addPreg);
    $("#addResp").on("click", addRespuestas);
})

// variables
let envioIdPregunta = 0;

// funciones

function addPreg() { // añade la pregunta a la bbdd
    // recoge los valores de los inputs
    var id_regla = $("#id_regla").val();
    var texto_preg = $("#enunciado").val();
    var id_usr = $("#sessionId").val();

    // INSERTAR PREGUNTA
    let dato = new FormData();
    dato.append("id_regla", id_regla);
    dato.append("enunciado", texto_preg);
    dato.append("idUsuario", id_usr);

    fetch("./php/addPregunta.php", {
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
            mensaje("Question registered, now enter the answers", "success", "#D5F5E3");
        })
        .catch(function(err) {
            Swal.fire("Error: " + err.status + " " + err.statusText);
        })

    selectIdPreg();
}

async function selectIdPreg() { // obtiene el id de la pregunta que se acaba de crear
    // CONSULTAR ID_PREG DEL INSERT ANTERIOR
    await fetch("./php/selectPregunta.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
        .then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                throw response;
            }
        })
        .then(function(data) {
            $(data.data).each((index, fila) => {
                console.log(fila.idPregunta);
                envioIdPregunta = fila.idPregunta;
            });
        })
        .catch(function(err) {
            Swal.fire("Error: " + err.status + " " + err.statusText);
        })

    console.log(envioIdPregunta);

    // llamada de funciones
    ocultarDivEnunciado();
    mostrarDivRespuestas();


}

async function addRespuestas() { // añade las respuestas a la bbdd
    console.log("Id pregunta es: " + envioIdPregunta);

    var textoRespuesta1 = $("#resp1").val();
    var textoRespuesta2 = $("#resp2").val();
    var textoRespuesta3 = $("#resp3").val();
    var textoRespuesta4 = $("#resp4").val();

    if ($("#ck1").is(':checked')) {
        var esCorrecta1 = 1;
    } else {
        var esCorrecta1 = 0;
    }

    if ($("#ck2").is(':checked')) {
        var esCorrecta2 = 1;
    } else {
        var esCorrecta2 = 0;
    }

    if ($("#ck3").is(':checked')) {
        var esCorrecta3 = 1;
    } else {
        var esCorrecta3 = 0;
    }

    if ($("#ck4").is(':checked')) {
        var esCorrecta4 = 1;
    } else {
        var esCorrecta4 = 0;
    }

    // INSERTAR RESPUESTAS
    let dato = new FormData();

    dato.append("respuesta1", textoRespuesta1);
    dato.append("respuesta2", textoRespuesta2);
    dato.append("respuesta3", textoRespuesta3);
    dato.append("respuesta4", textoRespuesta4);
    dato.append("correcta1", esCorrecta1);
    dato.append("correcta2", esCorrecta2);
    dato.append("correcta3", esCorrecta3);
    dato.append("correcta4", esCorrecta4);
    dato.append("id_preguntaAdd", envioIdPregunta);

    // console.log(dato);

    await fetch("./php/addRespuestas.php", {
            method: "POST",
            // headers: {
            //     "Content-Type": "application/x-www-form-urlencoded"
            // },
            body: dato
        })
        .then(function(response) {
            // console.log(response)
            if (response.ok) {
                return response.json();
            } else {
                throw response;
            }
        })
        .then(function(data) {
            mensaje("Answers registered", "success", "#D5F5E3");
            location.href = "questionList.php";
        })
        .catch(function(err) {
            Swal.fire("Error: " + err.status + " " + err.statusText);
        })

    // // recarga la página cuando termina de grabar las respuestas
    // location.reload();
}

function ocultarDivEnunciado() { // oculta el contenedor del enunciado
    $("#divEnunciado").hide();
}

function ocultarDivRespuestas() { // oculta el contenedor de las respuestas
    $("#divRespuestas").hide();
}

function mostrarDivRespuestas() { // muestra el contenedor de las respuestas
    $("#divRespuestas").show();
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