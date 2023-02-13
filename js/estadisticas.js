"use strict"

$(() => {
    mostrarEstadisticas();
})

// funciones

function mostrarEstadisticas() {
    fetch("./php/selectEstadisticas.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
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
            $(data.data).each((index, fila) => {
                // tiempoReal = secondsToString(fila.tiempo / 1000);
                let tiempoReal = fila.tiempo / 1000;

                let tiempoMinSeg = secondsToString(tiempoReal);

                $("tbody").append(`<tr><td>${fila.id_registro}</td> <td>${fila.num_aciertos}</td> <td>${fila.num_preg_total}</td> <td>${fila.nota}%</td> <td>${tiempoMinSeg}</td></tr>`);
            });

            $('#tableStats').DataTable();
        })
        .catch(function(err) {
            Swal.fire("Error: " + err.status + " " + err.statusText);
        })
}

function secondsToString(seconds) {
    var hour = Math.floor(seconds / 3600);
    hour = (hour < 10) ? '0' + hour : hour;
    var minute = Math.floor((seconds / 60) % 60);
    minute = (minute < 10) ? '0' + minute : minute;
    var second = Math.trunc(seconds % 60);
    second = (second < 10) ? '0' + second : second;

    return minute + ':' + second;
}