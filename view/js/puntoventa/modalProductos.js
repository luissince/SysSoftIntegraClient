function ModalProductos() {

    this.init = function () {

        $('#modalProductos').on('shown.bs.modal', function () {
            $('#txtSearchProducto').trigger('focus')
        })

        $("#btnOpenModalProductos").click(function () {
            if(true){
                $("#modalProductos").modal("show");
                // loadInitClientes();
                console.log('dentro al modal')
            } else {
                console.log('no dentro al modal');  
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
        // tbListaCliente.empty();
    }

}