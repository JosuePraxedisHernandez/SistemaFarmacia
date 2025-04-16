$(document).ready(function () {
    verificar_sesion()
    $('#form-login').submit((e)=>{
        let usser = $('#usuario').val()
        let pass = $('#password').val()
        login(usser, pass)
        e.preventDefault()
    })

    function login(usser, pass){
        let funcion='login'
        $.ajax({
            url: '/Sistema_Farmacia/Controlador/LoginController.php',
            data: {funcion, usser, pass},
            type: 'POST',
            success: function(Response){
                let respuesta = JSON.parse(Response)
                if(respuesta.mensaje=='success'){
                    console.log(Response)
                    location.href = "/Sistema_Farmacia/Vistas/Perfil.php"
                } else if(respuesta.mensaje=='error'){
                    console.log(Response)
                    Swal.fire({
                        title: "Error",
                        text: "Usuario o Contraseña Incorrectos",
                        icon: "error"
                    });
                    $('#form-login').trigger('reset')
                }
            }
        })
    }

    function verificar_sesion(){
        let funcion='verificar_sesion'
        $.ajax({
            url: '/Sistema_Farmacia/Controlador/LoginController.php',
            data: {funcion},
            type: 'POST',
            success: function(Response){
                try {
                    let respuesta = JSON.parse(Response)
                    console.log(respuesta)
                    if(respuesta.length!=0){
                        location.href = "/Sistema_Farmacia/Vistas/Perfil.php"
                    }
                } catch (error) {
                    console.error(error)
                    console.log(Response)
                }
            }
        })
    } 
})