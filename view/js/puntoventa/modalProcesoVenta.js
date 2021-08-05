function ModalProcesoVenta() {


    this.init = function () {

        $('#modalProcesoVenta').on('shown.bs.modal', function () {
            // $('#txtSearchLista').trigger('focus')
        })

        $("#btnCobrar").click(function () {
            if(true){
                $("#modalProcesoVenta").modal("show");
                console.log('dentro al ModalProcesoVenta')
            } else {
                console.log('no dentro al ModalProcesoVenta');  
            }
           
        });

        $("#btnCloseModalProcesoVenta").click(function () {
            clearModalProcesoVenta();
        });

        $("#btnCancelModalProcesoVenta").click(function () {
            clearModalProcesoVenta();
        });

    }

    function clearModalProcesoVenta() {
        $("#modalProcesoVenta").modal("hide");
        
    }

}