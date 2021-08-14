function ModalCantidad() {


    this.init = function () {

        $("#modalCantidad").on('shown.bs.modal', function () {
            $('#txtCambiarCantidad').trigger('focus')
        })

        $("#btnCantidad").click(function () {
            if (true) {
                $("#modalCantidad").modal("show");
                console.log('dentro al ModalCantidad')
            } else {
                // console.log('no dentro al ModalCantidad');  
            }

        });

        $("#btnCloseModalCantidad").click(function () {
            clearModalCantidad();
        });

        $("#btnCancelCantidad").click(function () {
            clearModalCantidad();
        });

    }

    function clearModalCantidad() {
        $("#modalCantidad").modal("hide");
        $("#txtCambiarCantidad").val("");

    }


}