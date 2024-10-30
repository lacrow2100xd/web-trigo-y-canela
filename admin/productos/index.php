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

$sql = "SELECT id, nombre, descripcion, precio, descuento, stock, id_Categoria FROM productos WHERE activo = 1";
$resultado = $con->query($sql);
$productos = $resultado->fetchAll(PDO::FETCH_ASSOC);


?>

<main>
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                    <h2>Productos</h2>
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
                            Productos
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
            <a href="nuevo.php" class="btn btn-primary mt-2">Nuevo</a>

            <div
                class="table-responsive mt-4"
            >
                <table
                    class="table table-hover"
                >
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Stock</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($productos as $producto){ ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES); ?></td>
                            <td><?php echo $producto['precio']; ?></td>
                            <td><?php echo $producto['stock']; ?></td>
                            <td>
                            <a class="btn btn-warning" href="edita.php?id=<?php echo $producto['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td><button
                                type="button"
                                class="text-white btn btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#modalElimina" data-bs-id="<?php echo $producto['id']; ?>">
                                <i class="lni lni-trash-can"></i>
                                </button>   
                            </td>
                           
                        </tr>
                        <?php } ?>
                    
                    </tbody>
                </table>
            </div>
            
        </div>
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
                    <div class="modal-body">¿Desea eliminar el producto?</div>
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
    </div>
</main>

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