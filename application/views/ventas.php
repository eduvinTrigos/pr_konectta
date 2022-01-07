<main role="main" >

  

  <div class="album py-5 bg-light">
    <div class="container">
        <h1 style="text-align: center;">Modulo de Ventas</h1>
      <div class="row m-0 justify-content-center" >
        

        <div class="col-md-4 col-lg-4 col-xs-4 text-center" >
           
            <label for="id" class="sr-only">ID</label>
            <input type="text" id="id" class="form-control" placeholder="id del producto" required>
            <label for="cantidad" class="sr-only">Cantidad</label>
            <input type="number" id="cantidad" class="form-control" placeholder="Cantidad de productos" required>
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit" id="compra">Comprar Producto</button>
           
        </div>
        <div class="col-md-12 col-lg-12 col-xs-12">
            <a href="index">Modulo de productos</a>
        </div>
       

    </div>
    </div>
  </div>

</main>
<script>
    
    $('#compra').on('click', function() {
        var id = $('#id').val();
        var cantidad = $('#cantidad').val();

        if (id == '' || cantidad == '') {
            Swal.fire('todos los campos son obligatorios');
            return;
        }

        $.ajax({
            type: "POST",
            url: "registrar_compra",
            data: { id: id, cantidad: cantidad },
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