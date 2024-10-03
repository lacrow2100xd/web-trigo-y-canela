<?php
include_once('Conexion.php');
class Productos
{

    var $objetos;
    private $acceso; 
    
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function llenar_productos()
    {
        $sql = "SELECT id, nombre, descripcion, imagen, precio, id_categoria FROM productos WHERE activo=1";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

}