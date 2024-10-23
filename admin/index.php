<?php

require_once 'config/database.php';
require_once 'config/config.php';
require_once 'clases/adminFunciones.php';

$db = new DataBase();
$con = $db->conectar();

/*$password = password_hash('admin',PASSWORD_DEFAULT);
$sql = "INSERT INTO admin (usuario, password, nombre, email, activo, fecha_alta)
VALUES ('admin', '$password', 'Administrador', 'trigoycanelacontacto@gmail.com','1',NOW())";
$con->query($sql);*/

$errors = [];

if(!empty($_POST)){
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    if(esNulo([$usuario, $password])){
        $errors[] = "Debe llenar todos los campos";
    }

    if(count($errors) == 0){
        $errors[] = login($usuario,$password, $con);
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trigo y canela</title>
    
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/registro.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
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

<main class="form-login m-auto">
    <div class="d-flex justify-content-center align-items-center mb-3">
        <div class="logo-name-inicio text-center d-flex align-items-center">
            <img src="../Img/Diseño_sin_título__1_-removebg-preview.png" id="img-logo" alt="Logo Panadería" class="img-fluid">
            <h2 id="login" class="m-0">Trigo y canela</h2>
        </div>
    </div>

    <div class="card shadow-sm espacios">
        <div class="text-left mb-3">
            <h4 id="inicia">Administrador</h4>
            
        </div>

        <form class="row g-3" action="index.php" method="post" autocomplete="off">

            <input type="hidden" name="proceso" value="<?php echo $proceso; ?>">

            <div class="form-floating">
                <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario" required>
                <label for="usuario"> Usuario</label>
            </div>
            <div class="form-floating">
                <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña" required>
                <label for="password"> Contraseña</label>
            </div>

            <?php mostrarMensajes($errors); ?>
            
            <div class="col-12">
                <a href="recupera.php">¿Olvidaste tu contraseña?</a>
            </div>

            <div class="d-grid gap-3 col-12">
                <button type="submit" class="btn ingresarUsuario" href="inicio.php">Iniciar sesión</button>
            </div>  
         


           
        </form>
    </div>
</main>








<script src="js/scripts.js"></script>        


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../Util/js/jquery.min.js"></script>
<script src="../Util/js/jquery.validate.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>







</body>

</html>
