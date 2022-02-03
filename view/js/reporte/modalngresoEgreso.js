function ModalngresoEgreso() {

    this.init = function () {
        $("#btnIngresosEgresos").click(function () {
            openModalIngresosEgresos();
        });

        $("#btnIngresosEgresos").keypress(function (event) {
            if (event.keyCode === 13) {
                openModalIngresosEgresos();
            }
            event.preventDefault();
        });

        $("#cbSelectVendedorIngresoEgreso").change(function () {
            $("#cbVendedorVIngresoEgreso").prop('disabled', $("#cbSelectVendedorIngresoEgreso").is(":checked"));
        });
    }

    function openModalIngresosEgresos() {
        $("#modalIngresoEgreso").modal("show");

        $("#modalIngresoEgreso").on("shown.bs.modal", async function () {
            $("#txtFIIngresoEgreso").val(tools.getCurrentDate());
            $("#txtFFIngresoEgreso").val(tools.getCurrentDate());

            $("#txtFIIngresoEgreso").focus();
            selectEmpleado();

            $("#btnPdfIngresoEgreso").bind("click", function () {
                if (!$("#cbSelectVendedorIngresoEgreso").is(":checked") && $('#cbVendedorVIngresoEgreso').val() == null) {
                    tools.AlertWarning("", "Seleccione un vendedor.");
                    $('#cbVendedorVIngresoEgreso').focus();
                } else {
                    let fechaInicial = $("#txtFIIngresoEgreso").val();
                    let fechaFinal = $("#txtFFIngresoEgreso").val();
                    if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                        let params = new URLSearchParams({
                            "txtFechaInicial": fechaInicial,
                            "txtFechaFinal": fechaFinal,
                            "usuario": $("#cbSelectVendedorIngresoEgreso").is(":checked") ? 0 : 1,
                            "idUsuario": $("#cbSelectVendedorIngresoEgreso").is(":checked") ? '' : $('#cbVendedorVIngresoEgreso').val()
                        });
                        window.open("../app/sunat/pdfresumeningresos.php?" + params, "_blank");
                    }
                }
            });

            $("#btnExcelIngresoEgreso").bind("click", function () {
                let fechaInicial = $("#txtFIIngresoEgreso").val();
                let fechaFinal = $("#txtFFIngresoEgreso").val();
                if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                    let params = new URLSearchParams({
                        "txtFechaInicial": fechaInicial,
                        "txtFechaFinal": fechaFinal
                    });
                    window.open("../app/sunat/excelresumeningreso.php?" + params, "_blank");
                }
            });

            $("#divOverlayIngresoEgreso").addClass("d-none");
        });

        $("#modalIngresoEgreso").on("hide.bs.modal", async function () {
            $("#btnPdfIngresoEgreso").unbind();
            $("#btnExcelIngresoEgreso").unbind();
        });
    }

    function selectEmpleado() {
        $('#cbVendedorVIngresoEgreso').empty();
        $('#cbVendedorVIngresoEgreso').select2({
            width: '100%',
            placeholder: "Buscar Empleado",
            ajax: {
                url: "../app/controller/EmpleadoController.php",
                type: "GET",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        type: "fillempleado",
                        search: params.term
                    };
                },
                processResults: function (response) {
                    let datafill = response.map((item, index) => {
                        return {
                            id: item.IdEmpleado,
                            text: item.NumeroDocumento + ' - ' + item.Informacion
                        };
                    });
                    return {
                        results: datafill
                    };
                },
                cache: true
            }
        });
    }

}