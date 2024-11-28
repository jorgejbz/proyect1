// funcion para ver la contrase;a si es correcta o no
$(document).ready(function(){
    //check admin password es correcta o nel
    $("#current_pwd").keyup(function(){
        
        var current_pwd = $("#current_pwd").val();
        
        $.ajax({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'post',
            url: '/admin/check-current-password',
            data:{current_pwd:current_pwd},
            success:function(resp){
                if(resp == "false"){
                    $("#verifyCurrentPwd").html("<font color='red'>Tu Contraseña es Incorrecta!</font>");
                    }else if(resp == "true"){
                        $("#verifyCurrentPwd").html("<font color='green'>Tu Contraseña es Correcta!</font>");
                    }
            },error:function(){
                alert("error");
            }
            });
    });
});

// Update user page status
$(document).on("click", ".updateUserStatus", function() {
    var status = $(this).children("i").attr("status");
    var page_id = $(this).attr("page_id");

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: '/admin/update-user-status',
        data: {
            status: status,
            page_id: page_id
        },
        success: function(resp) {
            if (resp['status'] == 0) {
                // Cambiar el icono de toggle a 'off' (inactivo)
                $("#page-" + page_id).html("<i class='fas fa-toggle-off' style='color:grey' aria-hidden='true' status='Inactive'></i>");
            } else if (resp['status'] == 1) {
                // Cambiar el icono de toggle a 'on' (activo)
                $("#page-" + page_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");
            }

            // Mostrar el mensaje de éxito dinámicamente
            if (resp.success_message) {
                var alertDiv = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 5px;">
                        <strong>Success!</strong> ${resp.success_message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`;
                
                // Mostrar el mensaje en un contenedor de alertas (asumiendo que tienes un div con id="alert-container")
                $('#alert-container').html(alertDiv);
            }

            // Recargar la página después de actualizar el estado
            // setTimeout(function() {
                location.reload();
            // }, 2000); // Recargar después de 2 segundos (o ajusta según sea necesario)
        },
        error: function() {
            alert("Error: algo salió mal.");
        }
    });
});

// Función para actualizar la página cada que cambia el status de capacidad
function actualizarNivelCapacidad() {
    $.ajax({
        url: "/admin/api/nivel-capacidad", // La URL para el método de tu controlador
        method: "GET",
        success: function(data) {
            // Verifica si 'nivel' está definido, incluso si es 0
            if (typeof data.nivel !== 'undefined') {
                // Si todo está bien, te muestra la capacidad
                $('#nivel-capacidad').text(data.nivel + '%');
            } else {
                // Si hay un problema con los datos recibidos
                $('#nivel-capacidad').text('Error de conexión holi perro');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Si está mal la URL o hay un problema con la solicitud AJAX
            $('#nivel-capacidad').text('Error de conexión, ESP32 Desconectado');
            console.error('Error al obtener el nivel de capacidad:', textStatus, errorThrown);
        }
    });
}

setInterval(actualizarNivelCapacidad, 3000); // Llama a la función cada 3 segundos


// chartjs grafica para nivel de capacidad de la tolva:
// Inicializa Chart.js
var ctx = document.getElementById('nivelCapacidadChart').getContext('2d');
var nivelCapacidadChart = new Chart(ctx, {
    type: 'line', // Gráfico de línea
    data: {
        labels: [], // Aquí irán las etiquetas de tiempo
        datasets: [{
            label: 'Nivel de Capacidad (%)',
            data: [], // Aquí irán los datos del nivel de capacidad
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderWidth: 1,
            fill: true
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 100 // Porque el nivel de capacidad es un porcentaje
            }
        }
    }
});

// Función para actualizar el gráfico
function actualizarGraficoNivelCapacidad() {
    $.ajax({
        url: "/admin/api/nivel-capacidad", // URL para obtener el nivel de capacidad
        method: "GET",
        success: function(data) {
            if (data.nivel) {
                var now = new Date(); // Obtén el tiempo actual
                var timeString = now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds();

                // Agregar el nuevo nivel de capacidad y tiempo al gráfico
                nivelCapacidadChart.data.labels.push(timeString);
                nivelCapacidadChart.data.datasets[0].data.push(data.nivel);

                // Limitar el número de puntos en el gráfico para que no crezca infinitamente
                if (nivelCapacidadChart.data.labels.length > 10) { // Solo muestra los últimos 10 puntos
                    nivelCapacidadChart.data.labels.shift();
                    nivelCapacidadChart.data.datasets[0].data.shift();
                }

                // Actualiza el gráfico
                nivelCapacidadChart.update();
            } else {
                console.error('Error al obtener el nivel de capacidad');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
        }
    });
}

// Llama a la función de actualización cada 3 segundos
setInterval(actualizarGraficoNivelCapacidad, 3000);


