$(document).ready(function() {
    
    var funcion;
    
    llenar_productos();
  
    function llenar_productos(){
        funcion="llenar_productos";
        $.post('../controllers/productos.php', { funcion } , (response)=>{
            
            console.log(response);
            let productos=JSON.parse(response);
            let contador=0;
            let template = '';
            productos.forEach(producto =>{   
                contador++;     
                template+=`
                <div class="col ">
                    <div class="card shadow-sm ">
                        <img src="../Img/productos/${producto.imagen}.jpg" class="card-img-top img-fluid" alt="Imagen responsiva">
                        <div class="card-body"> 
                            <h5 class="card-title">${producto.nombre}</h5>
                            <p class="card-text">$${producto.precio}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="detalles.php?id${producto.id}" class="btn rounded-pill detalles">Detalles</a>
                                </div>
                                    <a href="" class="btn rounded-pill agregar ">Agregar</a>
                                    
                            </div>          
                        </div>
                    </div>         
                </div>           
                `;
            });
            $('#productos_a_mostrar').html(template);
    
        })     
    }

})