<?php
require_once 'clases/clienteFunciones.php';
require_once 'config/config.php';
require_once 'config/database.php';
$db = new Database();
$con = $db->conectar();

$errors = [];
$showSweetAlert = false;    

if(!empty($_POST)){
    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $cedula = trim($_POST['cedula']);
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if(esNulo([$nombres, $apellidos, $email, $telefono, $cedula, $usuario, $password, $repassword])){
        $errors[] = "Debe llenar todos los campos";
    }

    if(!esEmail($email)){
        $errors[] = "La direccion de correo no es valida";
    }
    
    if(!validaPassword($password, $repassword)){
        $errors[] = "Las contraseñas no coinciden";
    }

    if(usuarioExiste($usuario, $con)){
        $errors[] = "El nombre del usuario $usuario ya existe";
    }

    if(emailExiste($email, $con)){
        $errors[] = "El correo electrónico $email ya existe";
    }

    if(count($errors) == 0){

        $id = registraCliente([$nombres,$apellidos, $email, $telefono, $cedula], $con);
       
        if($id > 0 ){

            require_once 'clases/mailer.php';
            $mailer = new Mailer();
            $token = generarToken();
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
            
            $idUsuario = registraUsuario([$usuario,$pass_hash,$token, $id], $con);

            if($idUsuario > 0){

                $url = SITE_URL . '/activa_cliente.php?id='. $idUsuario .'&token='.$token;
                $asunto = "Activar cuenta - trigo y canela";
                $cuerpo = "Estimado $nombres: <br> Para continuar con el proceso de registro debe hacer click en el 
                siguiente enlace <a href='$url'>Activar cuenta</a>";
                
                if($mailer->enviarEmail($email, $asunto, $cuerpo)){

                    $showSweetAlert = true;
                }
            }else{
                $errors[] = "Error al registrar usuario";              
            }
        }else{
            $errors[] = "Error al registrar cliente";
        }
    }   

}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trigo y canela</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/registro.css">
    <link rel="stylesheet" href="css/productos.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    

    
</head>
<body>
    
<header data-bs-theme="white">
  
<div class="navbar navbar-expand-lg navbar-light bg-transparent">

    <div class="container">
      <a href="index.php" class="navbar-brand">
       
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarHeader">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
        </ul>
        
         <a href="checkout.php" class="btn bg-transparent border border-light position-relative">
          
        </a>
        
      </div>

    </div>
  </div>
</header>

<main>
    <div class="container">

        <div class="card shadow-sm espacios">
        
        <div class="logo-name">
            <img src="Img/Diseño_sin_título__1_-removebg-preview.png" id="img-logo" alt="Logo Panadería">
            <h2 id="registro">Registro</h2>
        </div>

        <p id="datosCuenta">Para crear tu cuenta te pediremos algunos datos</p>

        <?php mostrarMensajes($errors);?>

        <form class="row g-3" action="registro.php" method="post" autocomplete="off">

            <div class="col-md-6">
                <label for="nombres"> Nombres</label>
                <input placeholder="Nombres" type="text" name="nombres" id="nombres" class="form-control" value="<?php echo isset($_POST['nombres']) ? htmlspecialchars($_POST['nombres']) : ''; ?>">
            </div>
            <div class="col-md-6">
                <label for="apellidos"> Apellidos</label>
                <input placeholder="Apellidos" type="text" name="apellidos" id="apellidos" class="form-control" value="<?php echo isset($_POST['apellidos']) ? htmlspecialchars($_POST['apellidos']) : ''; ?>">
            </div>
            <div class="col-md-6">
                <label for="email"> Correo electrónico</label>
                <input placeholder="Correo electrónico" type="email" name="email" id="email" class="form-control" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <span id="validaEmail" class="text-danger "></span>            
            </div>
            <div class="col-md-6">
                <label for="telefono"> Telefono</label>
                <input placeholder="Telefono" type="tel" name="telefono" id="telefono" class="form-control" value="<?php echo isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono']) : ''; ?>">
            </div>
            <div class="col-md-6">
                <label for="cedula"> Cedula</label>
                <input placeholder="Identificación" type="text" name="cedula" id="cedula" class="form-control" value="<?php echo isset($_POST['cedula']) ? htmlspecialchars($_POST['cedula']) : ''; ?>">
            </div>
            <div class="col-md-6">
                <label for="usuario"> Usuario</label>
                <input placeholder="Nombre de usuario" type="text" name="usuario" id="usuario" class="form-control" value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>">
                <span id="validaUsuario" class="text-danger "></span>
            </div>
            <div class="col-md-6 position-relative">
                <label for="password">Contraseña</label>
                <div class="input-group">
                    <input placeholder="Contraseña" type="password" name="password" id="password" class="form-control">
                    <span class="position-absolute password-toggle" onclick="togglePasswordVisibility('password', this)">
                        <img src="Img/iconos/eye-not-active.svg" id="togglePasswordIcon" alt="Mostrar contraseña" width="24">
                    </span>
                </div>
            </div>
            <div class="col-md-6 position-relative">
                <label for="repassword">Repetir contraseña</label>
                <div class="input-group">
                    <input placeholder="Repetir contraseña" type="password" name="repassword" id="repassword" class="form-control">
                    <span class="position-absolute password-toggle" onclick="togglePasswordVisibility('repassword', this)">
                        <img src="Img/iconos/eye-not-active.svg" id="toggleRepasswordIcon" alt="Mostrar contraseña" width="24">
                    </span>
                </div>
            </div>




            <div class="col-12 d-flex justify-content-center espacio">
                <button type="submit" class="btn" id="agregarCarrito">Registrarme</button>
            </div>  

        </form>

        </div>
    </div>

</main>

<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="emailModalLabel">Registro exitoso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Para terminar el proceso de registro, siga las instrucciones que le hemos enviado a la dirección de correo electrónico.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>




<script>

    let txtUsuario = document.getElementById('usuario');
    txtUsuario.addEventListener("blur", function(){
        existeUsuario(txtUsuario.value)
    },false)

    function existeUsuario(usuario){

        let url= "clases/clienteAjax.php"

        let formData = new FormData()
        formData.append("action", "existeUsuario")
        formData.append("usuario", usuario)

        

        fetch(url, {
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(data =>{
            
            let inputUsuario = document.getElementById('usuario'); // El input
            let mensajeValidacion = document.getElementById('validaUsuario'); // El span del mensaje

            if(data.ok) {
                inputUsuario.value = '';  // Limpiar el campo si el usuario no está disponible
                mensajeValidacion.innerHTML = 'Usuario no disponible';  // Mostrar el mensaje
                inputUsuario.style.border = "1px solid #dc3545";  // Aplicar borde rojo al input
            } else {
                mensajeValidacion.innerHTML = '';  // Limpiar el mensaje si el usuario está disponible
                inputUsuario.style.border = "";  // Restablecer el borde predeterminado
            }
        })
    }

    let txtEmail = document.getElementById('email');
    txtEmail.addEventListener("blur", function(){
        emailExiste(txtEmail.value)
    },false)

    function emailExiste(email){

        let url= "clases/clienteAjax.php"

        let formData = new FormData()
        formData.append("action", "emailExiste")
        formData.append("email", email)

        fetch(url, {
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(data =>{
            
            let inputEmail = document.getElementById('email'); // El input
            let mensajeValidacion = document.getElementById('validaEmail'); // El span del mensaje

            if(data.ok) {
                inputEmail.value = '';  // Limpiar el campo si el usuario no está disponible
                mensajeValidacion.innerHTML = 'Correo electrónico no disponible';  // Mostrar el mensaje
                inputEmail.style.border = "1px solid #dc3545";  // Aplicar borde rojo al input
            } else {
                mensajeValidacion.innerHTML = '';  // Limpiar el mensaje si el usuario está disponible
                inputEmail.style.border = "";  // Restablecer el borde predeterminado
            }
        })
    }



    function togglePasswordVisibility(inputId, iconElement) {
        const passwordInput = document.getElementById(inputId);
        const icon = iconElement.querySelector('img');

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.src = 'Img/iconos/eye-active.svg'; // Asegúrate de tener la versión del ícono para mostrar contraseña
        } else {
            passwordInput.type = "password";
            icon.src = 'Img/iconos/eye-not-active.svg'; // Volver al ícono original para ocultar contraseña
        }
}

</script>







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="Util/js/jquery.min.js"></script>
<script src="Util/js/jquery.validate.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
<?php if ($showSweetAlert): ?>
    Swal.fire({
        title: '¡Casi listo!',
        text: 'Para activar tu cuenta, haz click en el email que te acabamos de enviar.',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    });
<?php endif; ?>
</script>


</body>

</html>
