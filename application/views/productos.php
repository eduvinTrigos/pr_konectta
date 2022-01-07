<main role="main">

  

  <div class="album py-5 bg-light">
    <div class="container">
        <h1 style="text-align: center;">Modulo de Productos</h1>
      <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12" >
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
               Crear Producto
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="titleregistrar">Registrar Producto</h5>
                        <h5 class="modal-title text-center" id="titleeditar" style="display:none" >Editar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" id="id_product_edit" aria-describedby="id_product_edit">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Nombre">Nombre</label>
                                    <input type="text" class="form-control" id="Nombre" aria-describedby="Nombre">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="referencia">Referencia</label>
                                    <input type="text" class="form-control" id="referencia" aria-describedby="referencia">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Precio">Precio</label>
                                    <input type="text" class="form-control" id="Precio" aria-describedby="Precio">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="peso">Peso</label>
                                    <input type="text" class="form-control" id="peso" aria-describedby="peso">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categorias">Categorias</label>
                                    <select id="categorias" class="form-control">
                                        <option selected>selepciona</option>
                                        <?php for ($i=0; $i <count($categorias); $i++) { ?>
                                            <option value="<?php echo $categorias[$i]['id_categoria'];?>"><?php echo $categorias[$i]['nombre_categoria'];?></option>
                                        <?php };?>
                                    </select>
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Stock">Stock</label>
                                    <input type="text" class="form-control" id="Stock" aria-describedby="Stock">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
                        <button type="button" class="btn btn-primary" id="editar" style="display:none" > Editar</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-12 col-xs-12" >
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Id producto</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Referencia</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Fecha_creacion</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i <count($productos) ; $i++) {?> 
                        <tr>
                            <th scope="row"><?php echo $i+1;?></th>
                            <td><?php echo $productos[$i]['id'];?></td>
                            <td><?php echo $productos[$i]['nombre'];?></td>
                            <td><?php echo $productos[$i]['referencia'];?></td>
                            <td><?php echo number_format($productos[$i]['precio'],0,",",".");?></td>
                            <td><?php echo number_format($productos[$i]['peso'],0,",",".");?></td>
                            <td><?php echo $productos[$i]['nombre_categoria'];?></td>
                            <td><?php echo $productos[$i]['stock'];?></td>
                            <td><?php echo $productos[$i]['fecha_creacion'];?></td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                         <button type="button" class="btn btn-warning" id="btn_editar" onclick="btn_editar('<?php echo $productos[$i]['id'];?>')">Editar</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#EliminarModal" id="btn_eliminar" onclick="btn_eliminar('<?php echo $productos[$i]['id'];?>')">Eliminar</button>
                                    </div>
                                </div>
                                
                            </td>
                        </tr>
                    <?php };?>
                   
                    
                </tbody>
            </table>
        </div>
        <div class="col-md-12 col-lg-12 col-xs-12">
            <a href="ventas">Modulo de ventas</a>
        </div>
        <div class="modal fade" id="EliminarModal" tabindex="-1" aria-labelledby="EliminarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EliminarModalLabel">Eliminar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <input type="hidden" id="id_producto">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="eliminar">Eliminar</button>
                </div>
                </div>
            </div>
        </div>

    </div>
    </div>
  </div>

</main>
<script>
    $('#guardar').on('click', function() {
        var Nombre = $('#Nombre').val();
        var referencia = $('#referencia').val();
        var Precio = $('#Precio').val();
        var peso = $('#peso').val();
        var categorias = $('#categorias').val();
        var Stock = $('#Stock').val();
        var data = {
            'nombre': Nombre,
            'referencia': referencia,
            'precio': Precio,
            'peso': peso,
            'categoria': categorias,
            'stock': Stock
        };
        $.ajax({
            type: "POST",
            url: "Init/creacion_producto",
            data: { data: data },
            dataType: "JSON",
            success: function(data) {
                if (data['status']) {
                    location.reload();
                } else {
                    Swal.fire(data['msg'])
                }
            }
        });
    });

    function btn_eliminar($id) {
        $('#id_producto').val($id);
    }

    $('#eliminar').on('click', function() {
        var id = $('#id_producto').val();
        $.ajax({
            type: "POST",
            url: "Init/eliminacion_producto",
            data: { id: id },
            dataType: "JSON",
            success: function(response) {
                if (response['status']) {
                    location.reload();
                } else {
                    Swal.fire(data['msg'])
                }
            }
        });

    });

    function btn_editar(id) {

        var data_producto = [];
        $.ajax({
            type: "POST",
            url: "Init/listar_producto",
            data: { id: id },
            dataType: "JSON",
            async: false,
            success: function(data) {
                if (data['status']) {
                    data_producto = data['data'];
                } else {
                    Swal.fire(data['msg']);

                }
            }
        });

        $('#Nombre').val(data_producto['nombre']);
        $('#referencia').val(data_producto['referencia']);
        $('#Precio').val(data_producto['precio']);
        $('#peso').val(data_producto['peso']);
        $('select option[value="' + data_producto['id_categoria'] + '"]').attr("selected", true);
        $('#Stock').val(data_producto['stock']);
        $('#id_product_edit').val(id);
        document.getElementById('guardar').style.display = 'none';
        document.getElementById('titleregistrar').style.display = 'none';

        document.getElementById('titleeditar').style.display = 'block';
        document.getElementById('editar').style.display = 'block';

        $('#exampleModal').modal("show");

    }

    $('#editar').on('click', function() {
        var Nombre = $('#Nombre').val();
        var referencia = $('#referencia').val();
        var Precio = $('#Precio').val();
        var peso = $('#peso').val();
        var categorias = $('#categorias').val();
        var Stock = $('#Stock').val();
        var id = $('#id_product_edit').val();
        var data = {
            'nombre': Nombre,
            'referencia': referencia,
            'precio': Precio,
            'peso': peso,
            'categoria': categorias,
            'stock': Stock,
            'id': id
        };
        $.ajax({
            type: "POST",
            url: "Init/editar_producto",
            data: { data: data },
            dataType: "JSON",
            success: function(data) {

                if (data['status']) {
                    Swal.fire(data['msg'])
                    setInterval("location.reload()", 2000);
                } else {
                    Swal.fire(data['msg'])
                }
            }
        });
    });
</script>
