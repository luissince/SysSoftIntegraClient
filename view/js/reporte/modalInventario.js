function ModalInventario() {

    this.init = function () {

        $("#btnInventario").click(function () {
            openModalInventario();
        });

        tools.keyEnter($("#btnInventario"), function (event){
            openModalInventario();
        });

        loadInitInventario();
    }

    function loadInitInventario(){
        $("#modalInventario").on("shown.bs.modal", async function () {

        });

        $("#modalInventario").on("hide.bs.modal", async function () {

        });
    }

    function openModalInventario() {
        $("#modalInventario").modal("show");
    }

}