<?php
require_once '../config/config.php';
require_once '../config/database.php';

if(!isset($_SESSION['user_type']) ||  $_SESSION['user_type'] != 'admin'){
  header('Location: ../../index.php');
  exit;
}
                            
$db = new Database();
$con = $db->conectar();


$sql = "SELECT id_transaccion, fecha, status, total, CONCAT(nombres, ' ', apellidos) AS cliente
FROM compra 
INNER JOIN clientes on compra.id_cliente = clientes.id
ORDER BY DATE(fecha) DESC";
$resultado = $con->query($sql);

require_once '../layaouts/header.php';

?>

<main>
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                    <h2>Compras</h2>
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
                            Compras
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

        <a href="genera_reporte_compras.php" class="btn btn-danger mt-4">Reporte de compras</a>

          
            <div
                class="table-responsive mt-4 tables-wrapper"
            >
                <table
                    class="table table-hover"
                >
                    <thead>
                        <tr>
                        <th scope="col">Folio</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Total</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Detalles</th>    
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $resultado->fetch(PDO::FETCH_ASSOC)){ ?>
                        <tr>
                            <td><?php echo $row['id_transaccion'];?></td>
                            <td><?php echo $row['cliente'];?></td>
                            <td><?php echo number_format($row['total'], 0, '.',',');?></td>
                            <td><?php echo $row['fecha'];?></td>
                            <td>
                                <button
                                type="button"
                                class="btn   btn-primary"
                                data-bs-toggle="modal"
                                data-bs-orden="<?php echo $row['id_transaccion'];?>"
                                data-bs-target="#modalElimina" data-bs-id="<?php echo $row['id_transaccion']; ?>">
                                <i class="fa-solid fa-eye"></i>
                                </button>   
                              
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
    id="modalElimina"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
>
    <div
        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm modal-lg"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Detalles compra
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body"></div>
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

    const detalleModal = document.getElementById('modalElimina')
    if (detalleModal) {
      detalleModal.addEventListener('show.bs.modal', event => {
        
        const button = event.relatedTarget
        
        const orden = button.getAttribute('data-bs-orden')
      
        const modalBody = detalleModal.querySelector('.modal-body ')

        const url = '<?php echo ADMIN_URL; ?>compras/getCompra.php'

        let formData = new FormData()
        formData.append('orden', orden)

        fetch(url,{
          method: 'post',
          body: formData,

        })
        .then((resp) => resp.json())
        .then(function(data){
          modalBody.innerHTML = data
        })

      })
    }

    detalleModal.addEventListener('hide.bs.modal', event => {
        const modalBody = detalleModal.querySelector('.modal-body ')
        modalBody.innerHTML = ''
    })


</script>

<?php 

require_once '../layaouts/Footer.php';
?>