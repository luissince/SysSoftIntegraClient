<div class="row">
    <div class="modal fade" id="modalCantidad" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="fa fa-cubes"></i> Modificar cantidad
                    </h4>
                    <button type="button" class="close" id="btnCloseModalCantidad">
                        <i class="fa fa-close"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-center">
                                <h6>1234567890123 -<span> Descripción del producto</span></h6>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <div class="input-group-append">
                                <button id="btnDisminuir" class="btn btn-secondary" type="button" title="Disminuir"><i class="fa fa-minus text-danger"></i></button>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <input id="txtCambiarCantidad" type="text" class="form-control" placeholder="0.0">
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="input-group-append">
                                <button id="btnAumentar" class="btn btn-secondary" type="button" title="Aumentar"><i class="fa fa-plus text-success"></i></button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="text-center">
                                    <button id="btnCambiarCantidad" class="btn btn-info" type="button" title="Aceptar"><i class="fa fa-check"></i> Aceptar</button>
                                    <button id="btnCancelCantidad" class="btn btn-danger" type="button" title="Cancelar"><i class="fa fa-close"></i> Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>