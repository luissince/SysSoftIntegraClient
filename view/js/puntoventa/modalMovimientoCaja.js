function ModalMovimientoCaja() {

    this.init = function () {

        $("#btnMovimientoCaja").click(function () {
            $("#modalMovimientoCaja").modal("show");
        });

        $("#btnMovimientoCaja").keypress(function () {
            $("#modalMovimientoCaja").modal("show");
        });

        $("#modalMovimientoCaja").on('shown.bs.modal', function () {
            $("#cbxMovimiento").focus();
        });

        $("#modalMovimientoCaja").on("hide.bs.modal", function () {
            clearModalMovimientoCaja();
        });
    }

    function clearModalMovimientoCaja() {
        $("#cbxMovimiento").val("");
        $("#txtMonto").val("");
        $("#txtComentarioMovimiento").val("");
    }


}