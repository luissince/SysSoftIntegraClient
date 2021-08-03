<div class="row">
    <div class="modal fade" id="modalListaPrecios" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="fa fa-tags"></i> Lista de Precios
                    </h4>
                    <button type="button" class="close" id="btnCloseModalListaPrecios">
                        <i class="fa fa-close"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="d-flex">
                                <h6>1234567890123 - DESCRIPCION DEL PRODUCTO</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="sorting" style="width: 10%;">#</th>
                                            <th class="sorting" style="width: 50%;">Nombre</th>
                                            <th class="sorting" style="width: 20%;">Precio del monto</th>
                                            <th class="sorting" style="width: 20%;">Cantidad del monto</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbListaPrecios">
                                        <tr>
                                            <td>1</td>
                                            <td>Precio 1</td>
                                            <td>00.00</td>
                                            <td>00.00</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Precio 2</td>
                                            <td>00.00</td>
                                            <td>00.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label class="text-danger">Para elegir un precio hacer doble click en él.</label>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="text-right">
                                <button type="button" class="btn btn-danger btn-group-sm" id="btnCancelModalListaPrecios">
                                    <i class="fa fa-remove"></i> Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>