function ModalListaPrecios(){

    let tbListaPrecios = $("#tbListaPrecios");

    this.init = function(){
        $("#btnOpenModalListaPrecios").click(function () {
            $("#modalListaPrecios").modal("show");            
        });

        $("#btnCloseModalListaPrecios").click(function () {
            clearModalListaPrecios();
        });

        $("#btnCancelModalListaPrecios").click(function () {
            clearModalListaPrecios();
        });
    }

    onSelectPrice = function (id, price, factor) {
        $("#modalListaPrecios").modal("hide")
    }

    function clearModalListaPrecios() {
        $("#modalListaPrecios").modal("hide");
        tbListaPrecios.empty();
    }
}