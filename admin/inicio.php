<?php

require_once 'config/database.php';
require_once 'config/config.php';


if(!isset($_SESSION['user_type'])){
    header('Location: index.php');
    exit;
}

if($_SESSION['user_type'] != 'admin'){
    header('Location: ../index.php');
    exit;
}

include 'header.php'; 

$db = new DataBase();
$con = $db->conectar();

$hoy = date('Y-m-d');
$lunes = date('Y-m-d',strtotime('monday this week', strtotime($hoy)));
$domingo = date('Y-m-d',strtotime('sunday this week',strtotime($hoy)));

$fechaInicial = new DateTime($lunes);
$fechaFinal = new DateTime($domingo);

$diasVentas = [];
$totalSemana = 0;

for ($i = $fechaInicial; $i <= $fechaFinal; $i->modify('+1 day')) {
    $diasVentas[] = totalDia($con, $i->format('Y-m-d'));
    $totalDia = totalDia($con, $i->format('Y-m-d'));
    $totalSemana += $totalDia;
}

$diasVentas = implode(',', $diasVentas);

//---------------------------------------

$listaProductos = productosMasVendidos($con, $lunes, $domingo);
$nombreProductos = [];
$cantidadProductos = [];

foreach($listaProductos as $producto){
  $nombreProductos[] = $producto['nombre'];
  $cantidadProductos[] = $producto['cantidad'];
}

$nombreProductos = implode("','", $nombreProductos);
$cantidadProductos = implode(',', $cantidadProductos);


function totalDia($con, $fecha){
  $sql = "SELECT IFNULL(SUM(total),0) AS total FROM compra
  WHERE DATE(fecha) = '$fecha' AND status LIKE 'COMPLETED'";
  $resultado = $con->query($sql);
  $row = $resultado->fetch(PDO::FETCH_ASSOC);
  
  return $row['total'];
}

function productosMasVendidos($con, $fechaInicial, $fechaFinal){
  $sql = "SELECT SUM(dc.cantidad) AS cantidad, dc.nombre  FROM detalle_compra AS dc
  INNER JOIN compra AS c ON dc.id_compra = c.id
  WHERE DATE(c.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'
  GROUP BY dc.id_producto, dc.nombre
  ORDER BY SUM(dc.cantidad) DESC
  LIMIT 5";
  $resultado = $con->query($sql);
  return $resultado->fetchAll(PDO::FETCH_ASSOC);
  
}



$sql = "SELECT COUNT(*) AS total_productos FROM productos";
$resultado = $con->query($sql);
$totalProductos = $resultado->fetch(PDO::FETCH_ASSOC);

/* ------------------------------------------------ */


$sql = "SELECT SUM(total) AS total_compras
        FROM compra
        WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$resultado = $con->query($sql);
$totalCompras = $resultado->fetch(PDO::FETCH_ASSOC);

/* ------------------------------------------------ */

$sql = "
    SELECT COUNT(*) AS total_usuarios_activos
    FROM usuarios
    JOIN clientes ON usuarios.id_cliente = clientes.id
    WHERE usuarios.activacion = 1
    AND clientes.fecha_alta >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$resultado = $con->query($sql);
$totalUsuariosActivos = $resultado->fetch(PDO::FETCH_ASSOC);

/* ------------------------------------------------ */


$sql = "SELECT SUM(stock) AS total_stock FROM productos";
$resultado = $con->query($sql);
$totalStock = $resultado->fetch(PDO::FETCH_ASSOC);

/* ------------------------------------------------ */


// Consulta para obtener las ganancias del último mes
$sqlUltimoMes = "
    SELECT SUM(total) AS total_ultimo_mes
    FROM compra
    WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
";
$resultadoUltimoMes = $con->query($sqlUltimoMes);
$totalUltimoMes = $resultadoUltimoMes->fetch(PDO::FETCH_ASSOC)['total_ultimo_mes'];

// Consulta para obtener las ganancias del mes anterior al último mes
$sqlMesAnterior = "
    SELECT SUM(total) AS total_mes_anterior
    FROM compra
    WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 2 MONTH)
    AND fecha < DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
";
$resultadoMesAnterior = $con->query($sqlMesAnterior);
$totalMesAnterior = $resultadoMesAnterior->fetch(PDO::FETCH_ASSOC)['total_mes_anterior'];


if ($totalMesAnterior > 0) {
    $porcentajeCambio = (($totalUltimoMes - $totalMesAnterior) / $totalMesAnterior) * 100;
} else {
    $porcentajeCambio = $totalUltimoMes > 0 ? 100 : 0; 
}



?>


      <!-- ========== header end ========== -->

      <!-- ========== section start ========== -->
      <section class="section">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <div class="title">
                    <h2>Panel de control</h2>
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
                          Trigo y canela
                        </li>
                      </ol>
                    </nav>
                  </div>
                </div>
                <!-- end col -->
              </div>
              <!-- end row -->
            </div>

            <div class="row">
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                  <div class="icon purple">
                    <i class="lni lni-cart-full"></i>
                  </div>
                  <div class="content">
                    <h6 class="mb-10">Total productos</h6>
                    <h3 class="text-bold mb-10"><?php echo $totalProductos['total_productos'];?></h3>
                    <p class="text-sm text-success">
                      
                      <span class="text-gray">Total registrado</span>
                    </p>
                  </div>
                </div>
                <!-- End Icon Cart -->
              </div>
              <!-- End Col -->
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                  <div class="icon success">
                    <i class="lni lni-dollar"></i>
                  </div>
                  <div class="content">
                    <h6 class="mb-10">Ingresos totales</h6>
                    <h3 class="text-bold mb-10">$<?php echo number_format($totalCompras['total_compras'], 0, '.',',');?></h3>
                    <p class="text-sm <?php echo $porcentajeCambio > 0 ? 'text-success' : 'text-danger'; ?>">
                        <i class="lni <?php echo $porcentajeCambio > 0 ? 'lni-arrow-up' : 'lni-arrow-down'; ?>"></i>
                        <?php 
                            
                            echo ($porcentajeCambio > 0 ? '+' : '') . round($porcentajeCambio, 2) . '%'; 
                        ?>
                        <span class="text-gray">
                            <?php echo $porcentajeCambio > 0 ? 'Incremento' : 'Disminución'; ?>
                        </span>
                    </p>
                  </div>
                </div>
                <!-- End Icon Cart -->
              </div>

              <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="icon primary">
                <i class="fa-solid fa-cart-flatbed"></i>
                </div>
                <div class="content">
                  <h6 class="mb-10">Total en inventario</h6>
                  <h3 class="text-bold mb-10"><?php echo $totalStock['total_stock'];?></h3>
                  <p class="text-sm text-danger">
                    
                    <span class="text-gray">Inventario disponible</span>
                  </p>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
              <!-- End Col -->
              
              <!-- End Col -->
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                  <div class="icon orange">
                    <i class="lni lni-user"></i>
                  </div>
                  <div class="content">
                    <h6 class="mb-10">Nuevos usuarios</h6>
                    <h3 class="text-bold mb-10"><?php echo $totalUsuariosActivos['total_usuarios_activos'];?></h3>
                    <p class="text-sm text-danger">
                      
                      <span class="text-gray"> En el último mes</span>
                    </p>
                  </div>
                </div>
                <!-- End Icon Cart -->
              </div>
              <!-- End Col -->
            </div>

            <div class="row">
            <div class="col-lg-7">
              <div class="card-style mb-30">
                <div class="title d-flex flex-wrap justify-content-between">
                  <div class="left">
                    <h6 class="text-medium mb-10">Estadísticas semanales</h6>
                    <h3 class="text-bold">$<?php echo number_format($totalSemana, 0, '.',',');?></h3>
                  </div>
                  
                </div>
                <!-- End Title -->
                <div class="chart">
                  <canvas id="Chart1" style="width: 100%; height: 400px; margin-left: -35px;"></canvas>
                </div>
                <!-- End Chart -->
              </div>
            </div>
            <!-- End Col -->
            <div class="col-lg-5">
              <div class="card-style mb-30">
                <div class="title d-flex flex-wrap align-items-center justify-content-between">
                  <div class="left">
                    <h6 class="text-medium mb-30">Productos mas vendidos de la semana</h6>
                  </div>
                  
                </div>
                <!-- End Title -->
                <div class="chart">
                  <canvas id="Chart2" style="width: 100%; height: 400px; margin-left: -45px;"></canvas>
                </div>
                <!-- End Chart -->
              </div>
            </div>
            
          
            <!-- End Col -->
          </div>
            <!-- end row -->
          
          <!-- ========== title-wrapper end ========== -->
        </div>
        <!-- end container -->
      </section>
      <!-- ========== section end ========== -->

      <!-- ========== footer start =========== -->

      <?php include 'footer.php';?>