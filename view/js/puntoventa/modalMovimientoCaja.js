function ModalMovimientoCaja() {


    this.init = function () {

        $("#modalMovimientoCaja").on('shown.bs.modal', function () {
            $("#txtMonto").trigger('focus')
        })

        $("#btnMovimientoCaja").click(function () {
            if (true) {
                $("#modalMovimientoCaja").modal("show");
                console.log('dentro al ModalMovimientoCaja')
            } else {
                // console.log('no dentro al ModalMovimientoCaja');  
            }

        });

        $("#btnCloseModalMovimientoCaja").click(function () {
            clearModalMovimientoCaja();
        });

        $("#btnCancelMovimiento").click(function () {
            clearModalMovimientoCaja();
        });

    }

    function clearModalMovimientoCaja() {
        $("#modalMovimientoCaja").modal("hide");
        document.getElementById("cbxMovimiento").selectedIndex = "0"
        $("#txtMonto").val("");
        $("#txtComentarioMovimiento").val("");

    }


}