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

// Función para actualizar el nivel de capacidad automáticamente
function actualizarNivelCapacidad() {
    // Hacemos una petición AJAX al controlador
    $.ajax({
        url: "/nivel-capacidad", // Ruta que obtendrá el nivel
        method: "GET",
        success: function(data) {
            // Verifica si la respuesta tiene el campo 'nivel'
            if (data.nivel !== undefined) {
                console.log("Nivel de capacidad recibido:", data.nivel); // Para depuración
                $('#nivel-capacidad').text(data.nivel + '%');
            } else {
                console.log("Respuesta inesperada:", data); // Para depuración
                $('#nivel-capacidad').text('Datos no disponibles');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Si hay un error, mostramos un mensaje
            console.log("Error en la solicitud:", textStatus, errorThrown); // Para depuración
            $('#nivel-capacidad').text('Error de conexión pendejo');
        }
    });
}

// Ejecutar la función cada 5 segundos (5000 ms)
setInterval(actualizarNivelCapacidad, 5000);
