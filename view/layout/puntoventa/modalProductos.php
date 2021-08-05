<div class="row">
    <div class="modal fade" id="modalProductos" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="fa fa-archive"></i> Productos
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
                                    <a id="navListaProductos" class="nav-link active" href="#listProducts" role="tab" data-toggle="tab"><i class="fa fa-list"></i> Lista</a>
                                </li>
                                <li class="nav-item">
                                    <a id="navAgregarProducto" class="nav-link" href="#addProducto" role="tab" data-toggle="tab"><i class="fa fa-plus"></i> Agregar</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="listProducts">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="search" class="form-control" placeholder="Buscar por nombre o codigo de producto" aria-controls="sampleTable" id="txtSearchProducto">
                                                    <!-- <div class="input-group-append ml-1">
                                                        <button class="btn btn-success form-control" type="button" id="btnAddProducto" title="Agregar Producto"><i class="fa fa-plus"></i> Agregar</button>
                                                    </div> -->
                                                    <div class="input-group-append ml-1">
                                                        <button id="btnReloadProducto" class="btn btn-info form-control" type="button" title="Recargar"><i class="fa fa-refresh"></i> Recargar</button>
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
                                                    <tbody id="tbListaProductos">
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
                                            <div class="form-group">
                                                <label class="text-danger">Para elegir un producto hacer doble click en él.</label>
                                            </div>
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

                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="txtClave">Clave: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                <div class="input-group">
                                                    <input id="txtClave" type="text" class="form-control" placeholder="Código de barras">
                                                    <div class="input-group-append ml-1">
                                                        <button id="btnBarCode" class="btn btn-warning form-control" type="button" title="Crear codigo de barras"><i class="fa fa-barcode"></i> Crear</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtClaveAlterna">Clave Alterna: </label>
                                                <input id="txtClaveAlterna" type="text" class="form-control" placeholder="Clave alterna">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-md-12 text-center p-3">
                                                    <img src="./images/noimage.jpg" style="object-fit: cover;" width="100" height="100" id="lblImagen">
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <input type="file" id="fileImage" accept="image/png, image/jpeg, image/gif, image/svg" style="display: none" />
                                                    <label class="btn btn-warning" for="fileImage" id="txtFile"><i class="fa fa-photo"></i> Subir Imagen</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="txtDescripcion">Descripción: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                <input id="txtDescripcion" type="text" class="form-control" placeholder="Nombre del producto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="cbxUnidMedida">Unidad de medida: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                <select id="cbxUnidMedida" class="form-control">
                                                    <option value="">--selected--</option>
                                                    <option value="1">OPCIÓN 1</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="cbxCategoria">Categoria: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                <select id="cbxCategoria" class="form-control">
                                                    <option value="">--selected--</option>
                                                    <option value="1">OPCIÓN 1</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Se vende: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4">
                                                        <input type="radio" name="seVende" value="unidad" checked><span> Por unida/Pza o precio base</span>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <input type="radio" name="seVende" value="moneda"><span> Por valor monetario</span>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <input type="radio" name="seVende" value="granel"><span> A granel(Km, Ml, Cm, etc.)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <span>El articulo utilisa inventario</span>
                                                <input id="ckbInventario" type="checkbox">
                                                <hr class="mt-0" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-12">
                                            <div class="form-group">
                                                <label for="txtCosto">Costo: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                <input id="txtCosto" type="text" class="form-control" placeholder="0.0">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="txtInvMinimo">Inventario mínino: </label>
                                                        <input id="txtInvMinimo" type="text" class="form-control" placeholder="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="txtInvMaximo">Inventario Máximo: </label>
                                                        <input id="txtInvMaximo" type="text" class="form-control" placeholder="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Valor de salida de producto: </label>
                                                <div class="mb-2">
                                                    <input type="radio" name="valorSalida" value="unidad" checked><span> Por unida (cantidades)</span>
                                                </div>
                                                <div class="mb-2">
                                                    <input type="radio" name="valorSalida" value="moneda"><span> Por valor monetario ($, S/, etc)</span>
                                                </div>
                                                <div class="mb-2">
                                                    <input type="radio" name="valorSalida" value="medida"><span> Por medida (km, cm, galon, etc)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <span>Datos del precio</span>
                                                <hr class="mt-0" />
                                            </div>
                                            <div class="form-group">
                                                <label for="cbxImpuesto">Impuesto: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                <select id="cbxImpuesto" class="form-control">
                                                    <option value="">--selected--</option>
                                                    <option value="1">OPCIÓN 1</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <input type="radio" name="tipoPrecio" checked><span> Lista de precios normal</span>
                                                <input type="radio" name="tipoPrecio"><span> Lista de precios personalisados</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="txtPrecioGeneral">Precio General: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                <input id="txtPrecioGeneral" type="text" class="form-control" placeholder="00.00">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="txtPrecio2">Precio de venta 2: </label>
                                                <input id="txtPrecio2" type="text" class="form-control" placeholder="00.00">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="txtPrecio3">Precio de venta 3: </label>
                                                <input id="txtPrecio3" type="text" class="form-control" placeholder="00.00">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="txtPrecioVentaNeto">Precio de venta neto: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                <div class="input-group">
                                                    <input id="txtPrecioVentaNeto" type="text" class="form-control" placeholder="00.00">
                                                    <div class="input-group-append ml-1">
                                                        <button id="btnAddPrecio" class="btn btn-warning form-control" type="button" title="Agregar precio"><i class="fa fa-plus"></i> Agregar</button>
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
                                                        <tr role="row">
                                                            <th class="sorting" style="width: 40%;">Nombre</th>
                                                            <th class="sorting" style="width: 25%;">Precio del monto</th>
                                                            <th class="sorting" style="width: 25%;">Cantidad del monto</th>
                                                            <th class="sorting" style="width: 10%;">Opcion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbListaAddPrecios">
                                                        <tr role="row" class="odd">
                                                            <td><input type="text" class="form-control" placeholder="Nombre del precio" value="Precio 1" /></td>
                                                            <td><input type="text" class="form-control" placeholder="0.0" value="1.00" /></td>
                                                            <td><input type="text" class="form-control" placeholder="0.0" value="1.00" /></td>
                                                            <td class="text-center"><button class="btn btn-danger rounded"><i class="fa fa-trash"></i></button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="txtDescripcionAlterna">Descripcion Alterna: </label>
                                                <input id="txtDescripcionAlterna" type="text" class="form-control" placeholder="Descripcion Alterna">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="cbxEstado">Estado: </label>
                                                <select id="cbxEstado" class="form-control">
                                                    <option value="">--selected--</option>
                                                    <option value="1">OPCIÓN 1</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="cbxMarca">Marca: </label>
                                                <select id="cbxMarca" class="form-control">
                                                    <option value="">--selected--</option>
                                                    <option value="1">OPCIÓN 1</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="cbxPresentacion">Presentacion</label>: </label>
                                                <select id="cbxPresentacion" class="form-control">
                                                    <option value="">--selected--</option>
                                                    <option value="1">OPCIÓN 1</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="cbxClaveSunat">Clave unica del producto: </label>
                                                <input id="cbxClaveSunat" type="text" class="form-control" placeholder="Codigo unico de producto">
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-12">
                                            <div class="form-group">
                                                <label for="ckbLote">Lote: </label>
                                                <div>
                                                    <input id="ckbLote" type="checkbox"><span> Indica si maneja un control de lotes y caducidades para este articulo</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-0 mb-3" />
                                    <div class="row">
                                        <div class="col-md-8 col-sm-12">
                                            <div class="form-group">
                                                <label class="text-danger">Todos los campos marcados con <i class="fa fa-asterisk"></i> son necesaris rellenar.</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="text-right">
                                                <div class="form-group">
                                                    <button class="btn btn-success" type="button" id="btnAddProducto" title="Registrar Producto"><i class="fa fa-save"></i> Guardar</button>
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
        </div>
    </div>
</div>