<div class="row">
    <div class="modal fade" id="modalProductos" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <image src="./images/producto.png" width="22" /> Productos
                    </h4>
                    <button type="button" class="close" id="btnCloseModalProductos">
                        <i class="fa fa-close"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button id="btnReloadProducto" class="btn btn-danger" type="button" title="Recargar"><i class="fa fa-refresh"></i> Recargar</button>
                                    </div>
                                    <input type="search" class="form-control" placeholder="Buscar por nombre o codigo de producto" aria-controls="sampleTable" id="txtSearchProducto">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-header-background">
                                        <tr>
                                            <th class="text-center sorting" width="10%;">#</th>
                                            <th class="sorting" width="35%;">Clave/Nombre</th>
                                            <th class="sorting" width="15%;">Categoría/Marca</th>
                                            <th class="sorting" width="15%;">Cantidad</th>
                                            <th class="sorting" width="15%;">Impuesto</th>
                                            <th class="sorting" width="20%;">Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbListProductos">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="text-success">Para elegir un producto hacer doble click en él.</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="text-right">
                                <div class="form-group">
                                    <button class="btn btn-primary" id="btnAnteriorProducto">
                                        <i class="fa fa-arrow-circle-left"></i>
                                    </button>
                                    <span class="m-2" id="lblPaginaActualProducto">0
                                    </span>
                                    <span class="m-2">
                                        de
                                    </span>
                                    <span class="m-2" id="lblPaginaSiguienteProducto">0
                                    </span>
                                    <button class="btn btn-primary" id="btnSiguienteProducto">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>