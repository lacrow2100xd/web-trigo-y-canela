<?php
require_once 'clases/clienteFunciones.php';
require_once 'config/config.php';
require_once 'config/database.php';
$db = new Database();
$con = $db->conectar();

$user_id = $_GET['id'] ?? $_POST['user_id'] ?? '';
$token = $_GET['token'] ?? $_POST['token'] ?? '';

if($user_id == ''  || $token == ''){
    header("location : index.php");
}

$errors = [];
$showSweetAlert = false;   

if(!empty($_POST)){
   
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);
   

    if(esNulo([$user_id, $token, $password, $repassword])){
        $errors[] = "Debe llenar todos los campos";
    }

    if(!validaPassword($password, $repassword)){
        $errors[] = "Las contraseñas no coinciden";
    }
  

    if(count($errors) == 0){    
        
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        if(actualizaPassword($user_id,$pass_hash, $con)){
            
            $showSweetAlert = true;
            
        }
        else{
            $errors[] = "Error al modificar contraseña. Intentalo nuevamente";
        }

       
    }
}

if(!verificaTokenRequest($user_id,$token, $con)){
    echo "No se pudo verificar la informacion";
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trigo y canela</title>
    
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/registro.css">
    <link rel="stylesheet" href="css/recupera.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    
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


<main class="form-login m-auto">
<div class="d-flex justify-content-center align-items-center mb-3">
        <div class="logo-name-inicio text-center d-flex align-items-center">
            <img src="Img/Diseño_sin_título__1_-removebg-preview.png" id="img-logo" alt="Logo Panadería" class="img-fluid">
            <h2 id="login" class="m-0">Trigo y canela</h2>
        </div>
    </div>

    <div class="card shadow-sm espacios">
        <div class="d-flex mb-3">
            <h4 id="inicia">Cambiar tu contraseña</h4>
        </div>

        <form class="row g-3" action="reset_password.php" method="post" autocomplete="off">
            <input type="hidden" name="user_id" id="user_id" value="<?= $user_id; ?> " />
            <input type="hidden" name="token" id="token" value="<?= $token; ?> " />
            
            <div class="form-floating">
                <input class="form-control" type="password" name="password" id="password " 
                placeholder="Nueva contraseña">
                <label for="password"> Nueva contraseña</label>
            </div>
            <div class="form-floating">
                <input class="form-control" type="password" name="repassword" id="repassword " 
                placeholder="Confirmar contraseña">
                <label for="repassword"> Confirmar contraseña</label>
            </div>
            <?php mostrarMensajes($errors); ?>
            
            <div class="d-grid gap-3 col-12">
                <button type="submit" class="btn ingresarUsuario">Continuar</button>
            </div>  
         
            <div class="col-12">
                 <a href="login.php">Iniciar sesión</a> 
               
            </div>
            
           
        </form>
    </div>
    
</main>









<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="Util/js/jquery.min.js"></script>
<script src="Util/js/jquery.validate.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>





<script>
<?php if ($showSweetAlert): ?>
    Swal.fire({
    position: "center",
    icon: "success",
    title: "Contraseña modificada",
    showConfirmButton: false,
    timer: 1500
    }).then(() => {
        // Redirigir a index.php después de que se cierre el SweetAlert
        window.location.href = 'index.php';
    });
<?php endif; ?>
</script>




</body>

</html>

