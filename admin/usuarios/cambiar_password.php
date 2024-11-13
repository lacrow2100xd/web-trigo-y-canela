<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../clases/adminFunciones.php';
$db = new Database();
$con = $db->conectar();

$user_id = $_GET['user_id'] ?? $_POST['user_id'] ?? '';


if($user_id == ''){
    header("location : index.php");
}

$errors = [];
$showSweetAlert = false;   

if(!empty($_POST)){
   
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);
   

    if(esNulo([$user_id, $password, $repassword])){
        $errors[] = "Debe llenar todos los campos";
    }

    if(!validaPassword($password, $repassword)){
        $errors[] = "Las contraseñas no coinciden";
    }
  

    if(empty($errors)){    
        
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        if(actualizaPassword($user_id,$pass_hash, $con)){
            $showSweetAlert = true;
                    
        }
        else{
            $errors[] = "Error al modificar contraseña. Intentalo nuevamente";
        }

       
    }
}

$sql = "SELECT id, usuario FROM usuarios WHERE id = ?";
$sql  = $con->prepare ($sql);
$sql->execute([$user_id]);
$usuario = $sql->fetch(PDO::FETCH_ASSOC);



require_once '../layaouts/header.php';


?>


<main>
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                    <h2>Reestablecer contraseña</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper">
                      <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item">
                            <a href="<?php echo ADMIN_URL; ?>inicio.php">Panel de control</a>
                          </li>
                          <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL; ?>usuarios">Usuarios</a></li>
                          <li class="breadcrumb-item active" aria-current="page">
                            Reestablecer
                          </li>
                        </ol>
                      </nav>
                    </div>
                  </div>
                <!-- end col -->
                </div>
                <!-- end row -->
        </div>
        <div class="card-style">
            <form action="cambiar_password.php" method="post" autocomplete="off">

                <input type="hidden" name="user_id" value="<?php echo $usuario['id'];?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label mt-2"> Usuario</label>
                    <input
                        type="text"
                        class="form-control"
                        name="usuario"
                        id="usuario"
                        value="<?php echo $usuario['usuario'];?>"
                        disable
                    />
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label mt-2"> Nueva contraseña</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        id="password"
                        required autofocus
                    />
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label mt-2"> Confirmar contraseña</label>
                    <input
                        type="password"
                        class="form-control"
                        name="repassword"
                        id="repassword"
                        required autofocus
                    />
                </div>
                <?php mostrarMensajes($errors); ?>
                <button type="submit" class="btn btn-primary" required>  Actualizar
                </button>
                
            </form>
        </div>
    </div>
</main>



<?php require_once '../layaouts/Footer.php'; ?>





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

