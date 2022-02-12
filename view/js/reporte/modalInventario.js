function ModalInventario() {

    this.init = function () {

        $("#btnInventario").click(function () {
            openModalInventario();
        });

        tools.keyEnter($("#btnInventario"), function (event) {
            openModalInventario();
        });

        loadInitInventario();
    }

    function loadInitInventario() {
        $("#modalInventario").on("shown.bs.modal", async function () {
            try {
                let result = await tools.promiseFetchGet("../app/controller/AlmacenController.php", {
                    "type": "almacencombobox"
                }, function () {
                    $("#cbAlmacenInventario").empty();
                });

                $("#cbAlmacenInventario").append('<option value=""> - Seleccione -</option>');
                for (let value of result) {
                    $("#cbAlmacenInventario").append('<option value="' + value.IdAlmacen + '">' + value.Nombre + '</option> ');
                }

                $("#divOverlayInventario").addClass('d-none');
            } catch (error) {
                $("#lblTextOverlayInventario").html(tools.messageError(error));
            }
        });

        $("#modalInventario").on("hide.bs.modal", async function () {
            $("#divOverlayInventario").removeClass('d-none');
            $("#lblTextOverlayInventario").html("Cargando información...");
        });
    }

    function openModalInventario() {
        $("#modalInventario").modal("show");
    }

}