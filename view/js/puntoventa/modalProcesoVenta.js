function ModalProcesoVenta() {


    this.init = function () {

        $('#modalProcesoVenta').on('shown.bs.modal', function () {
            // $('#txtSearchLista').trigger('focus')
        })

        $("#btnCobrar").click(function () {
            if (true) {
                $("#modalProcesoVenta").modal("show");
                // console.log('dentro al ModalProcesoVenta')
            } else {
                // console.log('no dentro al ModalProcesoVenta');  
            }

        });

        $("#btnContado").click(function () {
            $("#btnContado").removeClass("btn-secondary");
            $("#btnContado").addClass("btn-primary");

            $("#btnCredito").removeClass("btn-primary");
            $("#btnCredito").addClass("btn-secondary");

            $("#btnAdelantado").removeClass("btn-primary")
            $("#btnAdelantado").addClass("btn-secondary")

            $("#boxContado").removeClass("d-none");
            $("#boxCredito").addClass("d-none");
            $("#boxAdelantado").addClass("d-none");

        });

        $("#btnCredito").click(function () {
            $("#btnCredito").removeClass("btn-secondary");
            $("#btnCredito").addClass("btn-primary");

            $("#btnContado").removeClass("btn-primary")
            $("#btnContado").addClass("btn-secondary")

            $("#btnAdelantado").removeClass("btn-primary")
            $("#btnAdelantado").addClass("btn-secondary")

            $("#boxContado").addClass("d-none");
            $("#boxCredito").removeClass("d-none");
            $("#boxAdelantado").addClass("d-none");

        });

        $("#btnAdelantado").click(function () {
            $("#btnAdelantado").removeClass("btn-secondary");
            $("#btnAdelantado").addClass("btn-primary");

            $("#btnContado").removeClass("btn-primary");
            $("#btnContado").addClass("btn-secondary");

            $("#btnCredito").removeClass("btn-primary");
            $("#btnCredito").addClass("btn-secondary");

            $("#boxContado").addClass("d-none");
            $("#boxCredito").addClass("d-none");
            $("#boxAdelantado").removeClass("d-none");
        });

        $("#btnCloseModalProcesoVenta").click(function () {
            clearModalProcesoVenta();
        });

    }

    function clearModalProcesoVenta() {
        $("#modalProcesoVenta").modal("hide");

        $("#btnContado").removeClass("btn-secondary");
        $("#btnContado").addClass("btn-primary");

        $("#btnCredito").removeClass("btn-primary");
        $("#btnCredito").addClass("btn-secondary");

        $("#btnAdelantado").removeClass("btn-primary")
        $("#btnAdelantado").addClass("btn-secondary")

        $("#boxContado").removeClass("d-none");
        $("#boxCredito").addClass("d-none");
        $("#boxAdelantado").addClass("d-none");

        $("#txtEfectivo").val('');
        $("#txtTarjeta").val('');
        // $("#txtFechaVencimiento").val(tools.getCurrentDate());
        $("#txtEfectivoAdelanto").val('');
        $("#txtTarjetaAdelanto").val('');
    }


}