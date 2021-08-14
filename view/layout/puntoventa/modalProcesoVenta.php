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
                            <div class="text-center">
                                <button id="btnContado" class="btn btn-primary" type="button" title="Pago al contado">
                                    <div class="text-center">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="text-center">
                                        <label>Contado</label>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="text-center">
                                <button id="btnCredito" class="btn btn-secondary" type="button" title="Pago al credito">
                                    <div class="text-center">
                                        <i class="fa fa-shopping-bag"></i>
                                    </div>
                                    <div class="text-center">
                                        <label>Credito</label>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="text-center">
                                <button id="btnAdelantado" class="btn btn-secondary" type="button" title="Pago adelantado">
                                    <div class="text-center">
                                        <i class="fa fa-suitcase"></i>
                                    </div>
                                    <div class="text-center">
                                        <label>Adelanto</label>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-3 mb-2"/>

                    <div id="boxContado">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="txtEfectivo">Efectivo: </label>
                                    <input id="txtEfectivo" type="text" class="form-control" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="txtTarjeta">Tarjeta: </label>
                                    <input id="txtTarjeta" type="text" class="form-control" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <div class="text-center">
                                        <h6>Por pagar: <span id="lblVuelto" class="text-primary">S/ 00.00</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="boxCredito" class="d-none">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="txtFechaVencimiento">Fecha de venciminto: </label>
                                    <input id="txtFechaVencimiento" type="date" class="form-control" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="boxAdelantado" class="d-none">
                    <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label><i class="fa fa-info text-info"></i> El proceso de pago adelantado consiste en registrar el monto/dinero sin modificar la cantidad de los productos agregados en el detalle de venta.</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="txtEfectivoAdelanto">Efectivo: </label>
                                    <input id="txtEfectivoAdelanto" type="text" class="form-control" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="txtTarjetaAdelanto">Tarjeta: </label>
                                    <input id="txtTarjetaAdelanto" type="text" class="form-control" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <div class="text-center">
                                        <h6>Por pagar: <span id="lblVueltoAdelanto" class="text-primary">S/ 00.00</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="text-center">
                                    <button id="btnCompletarVenta" class="btn btn-info" type="button" title="Procesar venta"><i class="fa fa-save"></i> Completar venta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>