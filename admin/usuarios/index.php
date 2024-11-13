<?php
require_once '../config/config.php';
require_once '../config/database.php';

if(!isset($_SESSION['user_type']) ||  $_SESSION['user_type'] != 'admin'){
  header('Location: ../../index.php');
  exit;
}

                            
$db = new Database();
$con = $db->conectar();


$sql = "SELECT usuarios.id, CONCAT(clientes.nombres, ' ',clientes.apellidos) AS cliente, usuarios.usuario, usuarios.activacion,
CASE 
WHEN usuarios.activacion = 1 Then 'activo'
WHEN usuarios.activacion = 0 Then 'no activado'
ELSE 'Deshabilitado'
END as estatus
FROM usuarios
INNER JOIN clientes ON usuarios.id_cliente = clientes.id";
$resultado = $con->query($sql);

require_once '../layaouts/header.php';

?>


<main>
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                    <h2>Usuarios</h2>
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
                        <li class="breadcrumb-item active" aria-current="page">
                            Usuarios
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
          
            <div
                class="table-responsive mt-4 tables-wrapper"
            >
                <table
                    class="table table-hover"
                >
                    <thead>
                        <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Restablecer </th>
                        <th scope="col">Activar / Desactivar </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $resultado->fetch(PDO::FETCH_ASSOC)){ ?>
                        <tr>
                            <td><?php echo $row['cliente'];?></td>
                            <td><?php echo $row['usuario'];?></td>
                            <td><?php echo $row['estatus'];?></td>
                  
                            <td>

                            <a href="cambiar_password.php?user_id=<?php echo $row['id'];?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                              
                            </td>

                            <td >
                                <?php if ($row['activacion']==1) : ?>
                                <button
                                type="button"
                                class="btn btn-danger tamañoigual"
                                data-bs-toggle="modal"
                                data-bs-user="<?php echo $row['id'];?>"
                                data-bs-target="#eliminaModal" data-bs-id="<?php echo $row['id']; ?>">
                                <i class="fa-solid fa-xmark"></i>
                                </button>   
                                <?php else : ?>

                                <button
                                type="button"
                                class="btn btn-success tamañoigual"
                                data-bs-toggle="modal"
                                data-bs-user="<?php echo $row['id'];?>"
                                data-bs-target="#activaModal" data-bs-id="<?php echo $row['id']; ?>">
                                <i class="fa-solid fa-check"></i>
                                </button>   

                                <?php endif; ?>

                            </td>
                            
                        
                        
                        </tr>
                        <?php } ?>
                    
                    </tbody>
                </table>
            </div>
            

        </div>
    

</main>

<div
    class="modal fade"
    id="eliminaModal"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
>
    <div
        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Alerta
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                ¿Desea deshabilitar este usuario?
            </div>
            <div class="modal-footer">
                <form action="deshabilita.php" method="post">
                    <input type="hidden" name="id">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cerrar
                    </button>
                    <button type="submit" class="btn btn-danger">Deshabilitar</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<div
    class="modal fade"
    id="activaModal"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
>
    <div
        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Alerta
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                ¿Desea activar este usuario?
            </div>
            <div class="modal-footer">
                <form action="activa.php" method="post">
                    <input type="hidden" name="id">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cerrar
                    </button>
                    <button type="submit" class="btn btn-success">Activar</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    

    const detalleModal = document.getElementById('eliminaModal')
   
      detalleModal.addEventListener('show.bs.modal', event => {
        
        const button = event.relatedTarget
        
        const user = button.getAttribute('data-bs-user')
      
        const inputId = detalleModal.querySelector('.modal-footer input')

        inputId.value = user

      })

      const activaModal = document.getElementById('activaModal')
   
      activaModal.addEventListener('show.bs.modal', event => {
        
        const button = event.relatedTarget
        
        const user = button.getAttribute('data-bs-user')
      
        const inputId = activaModal.querySelector('.modal-footer input')

        inputId.value = user

      })
   


</script>

<?php 

require_once '../layaouts/Footer.php';
?>