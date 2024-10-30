<?php


require_once '../config/database.php';
require_once '../config/config.php';


if(!isset($_SESSION['user_type'])){
    header('Location: ../index.php');
    exit;
}

if($_SESSION['user_type'] != 'admin'){
    header('Location: ../../index.php');
    exit;
}

require_once '../layaouts/header.php';

$db = new DataBase();
$con = $db->conectar();

$sql = "SELECT id, nombre FROM categorias WHERE activo = 1";
$resultado = $con->query($sql);
$categorias = $resultado->fetchAll(PDO::FETCH_ASSOC);


?>

<main>
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                    <h2>Articulos</h2>
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
                            Articulos
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

            <a href="nuevo.php" class="btn btn-primary mt-4">Nuevo</a>

            <div
                class="table-responsive mt-4 tables-wrapper"
            >
                <table
                    class="table table-hover"
                >
                    <thead>
                        <tr>
                            <th scope="col"><h6>Id</h6></th>
                            <th scope="col"><h6>Nombre</h6></th>
                            <th scope="col"><h6>Editar</h6></th>
                            <th scope="col"><h6>Eliminar</h6></th>
                
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($categorias as $categoria){ ?>
                        <tr>
                            <td><p><?php echo $categoria['id']; ?></p></td>
                            <td><p><?php echo $categoria['nombre']; ?></p></td>
                            <td>
                                <a class="btn btn-warning" href="edita.php?id=<?php echo $categoria['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            
                            </td>
                            <td>  
                                <button
                                type="button"
                                class="text-white btn btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#modalElimina" data-bs-id="<?php echo $categoria['id']; ?>">
                                <i class="lni lni-trash-can"></i>
                                </button>   
                            </td>
                        
                        
                        </tr>
                        <?php } ?>
                    
                    </tbody>
                </table>
            </div>
            

        </div>
    </div>
</main>



<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div
    class="modal fade"
    id="modalElimina"
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
                    Confirmar
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">¿Desea eliminar la categoria?</div>
            <div class="modal-footer">
                <form action="elimina.php" method="post">
                    <input type="hidden" name="id">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cerrar
                    </button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let eliminaModal = document.getElementById('modalElimina');
    eliminaModal.addEventListener('show.bs.modal', function(event) {
    let button = event.relatedTarget;
    let id = button.getAttribute('data-bs-id');

    let modalInput = eliminaModal.querySelector('.modal-footer input'); 
    modalInput.value = id;
});
</script>



<?php 

require_once '../layaouts/Footer.php';
?>