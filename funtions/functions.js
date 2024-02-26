function registrar(){
    const nombre = document.getElementById('nombre').value;
    const aPaterno = document.getElementById('aPaterno').value;
    const aMaterno = document.getElementById('aMaterno').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    // validar que no se encuentre vacios los campos
    if(nombre=="" && aPaterno=="" && aMaterno=="" && email =="" && password==""){
        Swal.fire({
            title: 'Error!',
            text: 'llena los campos solicitados',
            icon: 'error',
            confirmButtonText: 'cerrar'
          })
    }else {
      if(!validarEmail(email)){
        Swal.fire({
            title: 'Erro!',
            text: 'ingresa un correo valido',
            icon: 'error',
            confirmButtonText: 'cerrar'
          })
      }else{
        $.ajax({
            method:"POST",
            url:"controllers/registro.php",
            dataType: 'json',
            data: {nombre, aPaterno, aMaterno, email, password},
            success: function(response){
                if (response.success) {
                    Swal.fire({
                        title: 'exito!',
                        text: 'llena los campos solicitados',
                        icon: 'success',
                        confirmButtonText: 'cerrar'
                      }) 
                } else {
                    Swal.fire({
                        title: 'Ups!',
                        text: 'El email ya existe',
                        icon: 'error',
                        confirmButtonText: 'cerrar'
                      })
                }
            },
            error: function(error){
                alert(hola);
            }
        });
      }
    }
    function validarEmail(email) {
        // Expresión regular para validar el formato de un correo electrónico
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
      }
        
};
function iniciarSesion(){
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if(email=="" && password ==""){
     mostrarMensaje('Ups!', 'Porfavor llena todos los campos solicitados')
    } else if (!validarEmail(email)) {
           mostrarMensaje('Vaya!', 'Porfavor, ingresa un correo electronico valido')      
        } else {
            $.ajax({
                type:"POST",
                url:"controllers/login.php",
                dataType: 'json',
                data: {email, password},
                success: function(response){
                    console.log(response);
                    if(response.success){

                        window.location.replace('../dashboard.php');
                    }else{
                        mostrarMensaje('Error!', response.message)
                        
                    }
           
                },
                error: function(error) {
                    // Mostrar mensaje de error genérico
                    mostrarMensaje('Error!', 'Hubo un error en la solicitud.');
                },
                complete: function() {
                    // Reactivar el botón después de la solicitud (independientemente de si fue exitosa o no)
                    btnLogin.prop("disabled", false);
                }
                
            })
        }
       
};
function mostrarMensaje(title, text){
    Swal.fire({
        title: title,
        text: text,
        icon: 'error',
        confirmButtonText: 'cerrar'
      })
}
function validarEmail(email) {
    // Expresión regular para validar el formato de un correo electrónico
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }




