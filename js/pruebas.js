/*
    Autor: Rafael Cabezas Aranda
    Proyecto: RefGoal
    Fecha: 14/06/2022
*/

"use strict"

// variables
var numPreguntas = 0;
var aPreguntas = [];
var aEnunciados = [];
var iterator = 0;
var aCorrectas = [];
var aRespuestasUsr = [];
var aFullRespuestas = [];
var aRespUsr = [];
var acertadas = 0;
let tiempo, tiempoInicio, tiempoFinal;

$(() => {
    $("#enunciados").hide();
    $("#enviarNumPreg").on("click", cargarPreguntas);
    $("#enviarTest").on("click", enviarTest);
})

// funciones

function validarForm() {
    // let errNumPreg = comprobarValores(document.getElementById("numPreg"), document.getElementById("errNumPreg"));

    // $("#formNumPreg").validate({
    //     //estilo
    //     errorElement: "em",
    //     //Lugar donde vamos a mostrar el error
    //     errorPlacement: (error, element) => {
    //         error.addClass("invalid-feedback");
    //         error.insertAfter(element);
    //     },
    //     //borde al elemento erróneo
    //     highlight: (element) => {
    //         $(element).addClass("is-invalid").removeClass("is-valid");
    //     },
    //     //borde elemento correcto
    //     unhighlight: (element) => {
    //         $(element).addClass("is-valid").removeClass("is-invalid");
    //     },
    //     //reglas
    //     rules: {
    //         numPreg: {
    //             required: true,
    //             number: true,
    //             min: 1,
    //             max: 20
    //         }
    //     },
    //     messages: {
    //         numPreg: {
    //             required: "Please, enter a number of questions between 1-20",
    //             minlength: "Enter at least 1 question",
    //             maxlength: "Max 20 questions"
    //         }
    //     },
    //     submitHandler: () => { //el evento submit del botón
    //         cargarPreguntas();
    //     }
    // });
}

// function comprobarValores(objeto, spanErr) {
//     let error = false;

//     if (objeto.value == "") { // .value.length == 0
//         spanErr.innerText = "Required"; // si no introduce nada muestra mensaje de error
//         objeto.classList.add("errorTexto"); //establecer la clase errorTexto al objeto
//         error = true;
//     } else {
//         spanErr.innerText = ""; // si introduce algo, que no muestre el mensaje de error
//         objeto.classList.remove("errorTexto"); // quitar la clase errorTexto al objeto
//     }

//     return error;
// }

function cargarPreguntas(e) { // carga preguntas de la bd en un array
    tiempoInicio = new Date().getTime(); // crea la variable y empieza a contar el tiempo desde que pulsa el boton

    numPreguntas = parseInt($("#numPreg").val()); // recoge el valor del input
    ocultarDivPreg(); // oculta el contenedor
    $("#enunciados").show(); // muestra el contenedor con las preguntas

    while (aPreguntas.length < numPreguntas) { // genera numeros aleatorios sin repetir
        var numeroAleatorio = Math.ceil(Math.random() * 20); // numeros entre 1 y 20
        var existe = false;
        for (var i = 0; i < aPreguntas.length; i++) {
            if (aPreguntas[i] == numeroAleatorio) {
                existe = true;
                break;
            }
        }
        if (!existe) {
            aPreguntas[aPreguntas.length] = numeroAleatorio;
        }
        // console.log("Números aleatorios: " + aPreguntas + "<br>");
    }

    aPreguntas.forEach(element => { // realiza el bucle tantas veces como preguntas quiera el usuario
        let dato = new FormData();
        dato.append("aPreguntas", element);

        fetch("./php/preguntas.php", {
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
                $(data.data).each((index, ele) => {
                    // $("#enunciados").append(`<h2 id="${ele.id_preg}">${ele.id_preg} - ${ele.texto_preg}</h2>`);
                    aEnunciados.push(`${ele.id_preg} - ${ele.texto_preg}`);
                });
            })
            .catch(function(err) {
                Swal.fire("Error: " + err.status + " " + err.statusText);
            })
    });

    cargarRespuestas(aPreguntas);
    e.preventDefault();
}

function cargarRespuestas(aPreguntas) { // carga las respuestas de la bd en radiobuttons
    aPreguntas.forEach(element => {
        let dato2 = new FormData();
        dato2.append("id_preg", element);

        fetch("./php/respuestas.php", {
                method: "POST",
                body: dato2
            })
            .then(function(response) {
                if (response.ok) {
                    return response.json();
                } else {
                    throw response;
                }
            })
            .then(function(data) {

                $("#envioResp").append(`<br><p><b>${aEnunciados[iterator]}</b></p>`);

                $(data.data).each((index, ele2) => {
                    // console.log(ele2.texto_resp);
                    // $("#enunciados").append(`<p id="${ele2.id_resp}">${ele2.num_resp}. ${ele2.texto_resp}</p>`);
                    if (ele2.correcta == 1) { // si la respuesta actual es correcta la almacena en el array
                        aCorrectas.push(ele2.id_resp);
                    }

                    aFullRespuestas.push(ele2.id_resp); // guarda todas las respuestas en otro array

                    // genera los radiobuttons
                    // $("#envioResp").append(`<input type="radio" name="${ele2.id_preg}" id="${ele2.id_resp}"> ${ele2.num_resp}. ${ele2.texto_resp}<br>`);
                    $("#envioResp").append(`<input type="radio" name="${ele2.id_preg}" id="${ele2.id_resp}"> ${ele2.id_resp}. ${ele2.texto_resp}<br>`);
                });

                $("#envioResp").append(`<div id="contRespuestas${iterator}"></div><br>`);

                iterator++; // incrementa el iterador
            })
            .catch(function(err) {
                Swal.fire("Error: " + err.status + " " + err.statusText);
            })
    });
}

function enviarTest() { // comprueba las respuestas del test realizado por el usuario

    tiempoFinal = new Date().getTime(); // cuando pulsa el boton de enviar, almacena la fecha en mseg
    tiempo = tiempoFinal - tiempoInicio; // calcula la diferencia entre las dos fechas
    let tiempoSeg = Math.floor(tiempo / 1000); // pasa la fecha a segundos
    // let tiempoMin = (Math.floor(segundosP / 0x3C) % 0x3C).toString();

    // recorre el bucle con todas las respuestas
    aFullRespuestas.forEach(element => {
        // console.log(element);
        if ($("#" + element).is(':checked')) { // si está checkeada la añade a un array
            aRespUsr.push(element);
        }
    });

    console.log(aRespUsr);
    console.log(aCorrectas);

    if (aRespUsr.length != aCorrectas.length) {
        Swal.fire({
            icon: 'error',
            text: "Debes responder todas las preguntas"
        });

        for (let i = aRespUsr.length; i > 0; i--) {
            aRespUsr.pop();
        }

        console.log("Asi se queda el array: " + aRespUsr);
    } else {
        // recorre el bucle
        for (let i = 0; i < aCorrectas.length; i++) {
            if (aRespUsr[i] == aCorrectas[i]) { // compara los dos array y si coinciden incrementa acertadas
                acertadas++;
                // añade el span de correcta y oculta el de error
                $(`#contRespuestas${i}`).append(`<span class="respAcertada">Respuesta correcta</span>`);
            } else { // añade el span de error y oculta el de correcta
                $(`#contRespuestas${i}`).append(`<span class="respErronea">Error, la respuesta correcta es la ${aCorrectas[i]}</span>`);
            }
        }

        grabarDatos(); // llamada a la función

        Swal.fire({ // muestra un sweetAlert con los resultados
            icon: 'success',
            text: "¡Has acertado " + acertadas + "/" + aCorrectas.length + " preguntas en " + tiempoSeg + " segundos!",
            showCancelButton: true,
            confirmButtonColor: 'black',
            cancelButtonColor: '#42a05d',
            confirmButtonText: 'Empezar otro test',
            cancelButtonText: 'Ver resultados'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            } else {
                $("#enviarTest").hide(); // oculta el boton enviar test para evitar errores
            }
        });

    }
}

function grabarDatos() { // graba los resultados del test en la bbdd
    let nota = (acertadas * 100) / numPreguntas;

    let dato = new FormData();
    dato.append("num_aciertos", acertadas);
    dato.append("num_total", numPreguntas);
    dato.append("nota_usr", nota);
    dato.append("tiempo", tiempo);

    fetch("./php/addRegistroTest.php", {
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
            console.log("Intento grabado con éxito");
        })
        .catch(function(err) {
            Swal.fire("Error: " + err.status + " " + err.statusText);
        })
}

function ocultarDivPreg() { // oculta un contenedor y muestra el otro
    $(".contenedor").hide();
    $("#enunciados").show();
}