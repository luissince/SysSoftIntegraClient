function ModalPrecio() {


    this.init = function () {

        $("#modalPrecio").on('shown.bs.modal', function () {
            $('#txtCambiarPrecio').trigger('focus')
        })

        $("#btnPrecio").click(function () {
            if (true) {
                $("#modalPrecio").modal("show");
                console.log('dentro al ModalPrecio')
            } else {
                // console.log('no dentro al ModalPrecio');  
            }

        });

        $("#btnCloseModalPrecio").click(function () {
            clearModalPrecio();
        });

        $("#btnCancelPrecio").click(function () {
            clearModalPrecio();
        });

    }

    function clearModalPrecio() {
        $("#modalPrecio").modal("hide");
        $("#txtCambiarPrecio").val("");

    }


}