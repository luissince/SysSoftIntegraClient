function ModalProductos() {


    this.init = function () {

        $('#modalProductos').on('shown.bs.modal', function () {
            $('#txtSearchProducto').trigger('focus')
        })

        $("#btnProductos").click(function () {
            if(true){
                $("#modalProductos").modal("show");
                console.log('dentro al modal Productos')
            } else {
                console.log('no dentro al modal Productos');  
            }
           
        });

        $("#btnCloseModalProductos").click(function () {
            clearModalProductos();
        });

        $("#btnCancelModalProductos").click(function () {
            clearModalProductos();
        });

    }


    function clearModalProductos() {
        $("#modalProductos").modal("hide");

        // $("#tbListaProductos").empty();
        // $("#tbListaAddPrecios").empty();

        $("#navListaProductos").removeClass("active");
        $("#navAgregarProducto").removeClass("active");
        $("#navListaProductos").addClass("active");

        $("#listProducts").removeClass("in active show");
        $("#addProducto").removeClass("in active show");
        $("#listProducts").addClass("in active show");
    }

}