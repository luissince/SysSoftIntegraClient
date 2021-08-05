<div class="row">
    <div class="modal fade" id="modalProcesoVenta" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="fa fa-shopping-bag"></i> Completar venta
                    </h4>
                    <button type="button" class="close" id="btnCloseModalProcesoVenta">
                        <i class="fa fa-close"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-center">
                                <h3>Total a pagar: <span>S/ 10.00</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <hr>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <h6 class="text-center">Tipos de pagos</h6>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="input-group text-center">
                                <div class="input-group-append">
                                    <button id="btnContado" class="btn btn-secondary" type="button" title="Pago al contado">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <i class="fa fa-money"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                Al contado
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="input-group text-center">
                                <div class="input-group-append">
                                    <button id="btnCredito" class="btn btn-secondary" type="button" title="Pago al credito">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <i class="fa fa-shopping-bag"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                Al credito
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 bg-primary ">
                            <!-- <div class="input-group"> -->
                                <!-- <div class="input-group-append"> -->
                                    <button id="btnAdelantado" class="btn btn-secondary" type="button" title="Pago Adelantado">
                                        <!-- <div class="row"> -->
                                            <div class="text-center">
                                                <i class="fa fa-suitcase"></i>
                                            </div>
                                        <!-- </div> -->
                                        <!-- <div class="row"> -->
                                            <div class="text-center">
                                                <label>Pago Adelantado</label>
                                            </div>
                                        <!-- </div> -->
                                    </button>
                                <!-- </div> -->
                            <!-- </div> -->
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