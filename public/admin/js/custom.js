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

//funcion para actualizar la pagina cada que cambia el status de capacidad
function actualizarNivelCapacidad() {
    $.ajax({
        url: "/admin/api/nivel-capacidad", // La URL para el método de tu controlador
        method: "GET",
        success: function(data) {
            if (data.nivel) {
                $('#nivel-capacidad').text(data.nivel + '%');
            } else {
                $('#nivel-capacidad').text('Error de conexión holi');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#nivel-capacidad').text('Error de conexión esta mal en algo xd');
            console.error('Error al obtener el nivel de capacidad:', textStatus, errorThrown);
        }
    });
}

setInterval(actualizarNivelCapacidad, 5000); // Llama a la función cada 5 segundos
