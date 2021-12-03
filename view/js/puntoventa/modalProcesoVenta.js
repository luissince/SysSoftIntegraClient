function ModalProcesoVenta() {


    this.init = function () {

        $("#btnCobrar").click(function () {
            modalVenta();
        });

        $("#btnCobrar").keypress(function (event) {
            if (event.keyCode === 13) {
                modalVenta();
                event.preventDefault();
            }
        });

        $('#modalProcesoVenta').on('shown.bs.modal', function () {
            $('#txtEfectivo').trigger('focus');
        });

        $('#modalProcesoVenta').on('hide.bs.modal', function () {
            clearModalProcesoVenta();
        });

        $("#txtEfectivo").keyup(function (event) {
            if ($("#txtEfectivo").val() == "") {
                vueltoContado = total_venta;
                TotalAPagarContado();
                return;
            }
            if (tools.isNumeric($("#txtEfectivo").val())) {
                TotalAPagarContado();
            }
        });

        $("#txtEfectivo").keydown(function (event) {
            if (event.keyCode == 13) {
                crudVenta();
                event.preventDefault();
            }
        });

        $("#txtEfectivo").keypress(function (event) {
            var key = window.Event ? event.which : event.keyCode;
            var c = String.fromCharCode(key);
            if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                event.preventDefault();
            }
            if (c == '.' && $("#txtEfectivo").val().includes(".")) {
                event.preventDefault();
            }
        });

        $("#txtTarjeta").keyup(function (event) {
            if ($("#txtTarjeta").val() == "") {
                vueltoContado = total_venta;
                TotalAPagarContado();
                return;
            }
            if (tools.isNumeric($("#txtTarjeta").val())) {
                TotalAPagarContado();
            }
        });

        $("#txtTarjeta").keydown(function (event) {
            if (event.keyCode == 13) {
                crudVenta();
                event.preventDefault();
            }
        });

        $("#txtTarjeta").keypress(function (event) {
            var key = window.Event ? event.which : event.keyCode;
            var c = String.fromCharCode(key);
            if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                event.preventDefault();
            }
            if (c == '.' && $("#txtTarjeta").val().includes(".")) {
                event.preventDefault();
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
            state_view_pago = 0;
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
            state_view_pago = 1;
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
            state_view_pago = 2;
        });

        $("#btnCompletarVenta").click(function () {
            crudVenta();
        });

        $("#btnCompletarVenta").keypress(function (event) {
            if (event.keyCode == 13) {
                crudVenta();
                event.preventDefault();
            }
        });
    }

    this.resetProcesoVenta = function () {
        $("#modalProcesoVenta").modal("hide");
        clearModalProcesoVenta();
    }

    function clearModalProcesoVenta() {
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
        $("#txtEfectivoAdelanto").val('');
        $("#txtTarjetaAdelanto").val('');
        $("#lblVueltoNombre").html('Su cambio:');
        $("#lblVuelto").html(monedaSimbolo + ' 0.00');

        state_view_pago = 0;
        vueltoContado = 0;
        total_venta = 0;
        estadoCobroContado = false;
    }

    function TotalAPagarContado() {
        if ($("#txtEfectivo").val() == '' && $("#txtTarjeta").val() == '') {
            $("#lblVuelto").html(monedaSimbolo + " 0.00");
            $("#lblVueltoNombre").html("POR PAGAR: ");
            estadoCobroContado = false;
        } else if ($("#txtEfectivo").val() == '') {
            if (parseFloat($("#txtTarjeta").val()) >= total_venta) {
                vueltoContado = parseFloat($("#txtTarjeta").val()) - total_venta;
                $("#lblVueltoNombre").html("SU CAMBIO ES: ");
                estadoCobroContado = true;
            } else {
                vueltoContado = total_venta - parseFloat($("#txtTarjeta").val());
                $("#lblVueltoNombre").html("POR PAGAR: ");
                estadoCobroContado = false;
            }
        } else if ($("#txtTarjeta").val() == '') {
            if (parseFloat($("#txtEfectivo").val()) >= total_venta) {
                vueltoContado = parseFloat($("#txtEfectivo").val()) - total_venta;
                $("#lblVueltoNombre").html("SU CAMBIO ES: ");
                estadoCobroContado = true;
            } else {
                vueltoContado = total_venta - parseFloat($("#txtEfectivo").val());
                $("#lblVueltoNombre").html("POR PAGAR: ");
                estadoCobroContado = false;
            }
        } else {
            let suma = (parseFloat($("#txtEfectivo").val())) + (parseFloat($("#txtTarjeta").val()));
            if (suma >= total_venta) {
                vueltoContado = suma - total_venta;
                $("#lblVueltoNombre").html("SU CAMBIO ES: ");
                estadoCobroContado = true;
            } else {
                vueltoContado = total_venta - suma;
                $("#lblVueltoNombre").html("POR PAGAR: ");
                estadoCobroContado = false;
            }
        }

        $("#lblVuelto").html(monedaSimbolo + " " + tools.formatMoney(vueltoContado, 2));
    }

}