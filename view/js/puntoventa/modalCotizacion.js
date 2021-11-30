function ModalCotizacion() {

    this.init = function () {
        $("#btnCotizacion").click(function () {
            $("#modalCotizacion").modal("show");
        });

        $("#btnCotizacion").keypress(function (event) {
            if (event.keyCode == 13) {
                $("#modalCotizacion").modal("show");
                event.preventDefault();
            }
        });

        $("#modalCotizacion").on('shown.bs.modal', function () {

        });

        $("#modalCotizacion").on("hide.bs.modal", function () {

        });
    }

}