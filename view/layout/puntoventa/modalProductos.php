<div class="row">
    <div class="modal fade" id="modalProductos" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="fa fa-list"></i> Productos
                    </h4>
                    <button type="button" class="close" id="btnCloseModalProductos">
                        <i class="fa fa-close"></i>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="tile">
                        <div class="tile-body">
                            <ul class="nav nav-tabs mb-2" role="tablist">
                                <li class="nav-item">
                                    <a id="navListaProducto" class="nav-link active" href="#listaProducto" role="tab" data-toggle="tab">Lista</a>
                                </li>
                                <li class="nav-item">
                                    <a id="navAgregarProducto" class="nav-link" href="#addProducto" role="tab" data-toggle="tab">Agregar</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="listaProducto">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group d-flex">
                                                <div class="input-group">
                                                    <input type="search" class="form-control" placeholder="Buscar por nombre o codigo de producto" aria-controls="sampleTable" id="txtSearchProducto">
                                                    <div class="input-group-append ml-1">
                                                        <button class="btn btn-success form-control" type="button" id="btnAddProducto" title="Agregar Producto"><i class="fa fa-plus"></i> Agregar</button>
                                                    </div>
                                                    <div class="input-group-append ml-1">
                                                        <button class="btn btn-info form-control" type="button" id="btnReloadProducto" title="Recargar"><i class="fa fa-refresh"></i> Recargar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="sorting" style="width: 10%;">#</th>
                                                            <th class="sorting" style="width: 45%;">Clave/Nombre</th>
                                                            <th class="sorting" style="width: 15%;">Categoría/Marca</th>
                                                            <th class="sorting" style="width: 15%;">Cantidad</th>
                                                            <th class="sorting" style="width: 15%;">Precio</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbListaPrecios">
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Producto 1</td>
                                                            <td>00.00</td>
                                                            <td>00.00</td>
                                                            <td>00.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Producto 2</td>
                                                            <td>00.00</td>
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
                                            <label class="text-danger">Para elegir un producto hacer doble click en él.</label>
                                            <!-- <div class="text-right">
                                                <button type="button" class="btn btn-danger btn-group-sm" id="btnCancelModalProductos">
                                                    <i class="fa fa-remove"></i> Cancelar</button>
                                            </div> -->
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="text-right">
                                                <div class="form-group">
                                                    <button class="btn btn-info" id="btnAnteriorProducto">
                                                        <i class="fa fa-arrow-circle-left"></i>
                                                    </button>
                                                    <span class="m-2" id="lblPaginaActualProducto">0
                                                    </span>
                                                    <span class="m-2">
                                                        de
                                                    </span>
                                                    <span class="m-2" id="lblPaginaSiguienteProducto">0
                                                    </span>
                                                    <button class="btn btn-info" id="btnSiguienteProducto">
                                                        <i class="fa fa-arrow-circle-right"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="addProducto">

                                    <div>
                                    </div>

                                </div>



                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>