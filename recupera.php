<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<?php
require 'clases/clienteFunciones.php';
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$errors = [];


if(!empty($_POST)){
   
    $email = trim($_POST['email']);
   

    if(esNulo([$email])){
        $errors[] = "Debe llenar todos los campos";
    }

    if(!esEmail($email)){
        $errors[] = "La direccion de correo no es valida";
    }

    if(count($errors) == 0){

        if(emailExiste($email, $con)){
            $sql = $con->prepare("SELECT usuarios.id, clientes.nombres FROM usuarios
            INNER JOIN clientes ON usuarios.id_cliente=clientes.id
            WHERE clientes.email LIKE ? LIMIT 1");
            $sql->execute([$email]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $user_id = $row['id'];
            $nombres = $row['nombres'];

            $token = solicitaPassword($user_id, $con);

            if($token !== null){
                require 'clases/mailer.php';
                $mailer = new Mailer();

                $url = SITE_URL . '/reset_password.php?id='. $user_id .'&token='.$token;

                $asunto = "Solicitud para restablecer contraseña de trigo y canela";
                $cuerpo = "Hola, !$nombres: <br> 
                Haz clic en el siguiente botón para restablecer tu contraseña.
                Si no has solicitado una nueva contraseña, ignora este correo. 
                <br>
                <button><a href='$url'>Reestablecer contraseña</a></button>";

                if($mailer->enviarEmail($email, $asunto, $cuerpo)){

                    echo "<script type='text/javascript'>
                    $(document).ready(function(){
                        $('#emailModal').modal('show');
                    });
                  </script>";
                }
            }
        }else{
            $errors[] = "No existe una cuenta asociada a esta direccion de correo electrónico";
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
    
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/registro.css">
    <link rel="stylesheet" href="css/recupera.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    
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
            <a href="login.php">
                <i class="fa-solid fa-chevron-left" style="font-size: 1.2rem;"></i> <!-- Tamaño del icono ajustado -->
            </a>
            <h4 id="inicia">Recupera tu contraseña</h4>
        </div>

        <form class="row g-3" action="recupera.php" method="post" autocomplete="off">
            
            <div class="form-floating">
                <input class="form-control" type="email" name="email" id="email " placeholder="Correo eletrónico">
                <label for="email"> Correo electrónico</label>
            </div>
            <?php mostrarMensajes($errors); ?>
            
            <div class="d-grid gap-3 col-12">
                <button type="submit" class="btn ingresarUsuario">Continuar</button>
            </div>  
         
            <div class="col-12">
                <span class="p-login">¿No tienes cuenta?</span> <a href="registro.php">Registrate aqui</a> 
               
            </div>
            
           
        </form>
    </div>
    
</main>


<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="emailModalLabel">Instrucciones enviadas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Hemos enviado instrucciones para cambiar tu contraseña a <strong><?php echo $email; ?></strong>. Revisa la bandeja de entrada y la carpeta de spam.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-modal" data-dismiss="modal">Vale</button>
      </div>
    </div>
  </div>
</div>

<!-- Incluir jQuery y Bootstrap JS al final de la página -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>

</html>
