<?php
session_start();
if (!isset($_SESSION['IdEmpleado'])) {
    echo '<script>location.href = "login.php";</script>';
} else {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include './layout/head.php'; ?>
    </head>

    <body class="app sidebar-mini">
        <!-- Navbar-->
        <?php include "./layout/header.php"; ?>
        <!-- Sidebar menu-->
        <?php include "./layout/menu.php"; ?>

        <div class="modal fade" id="modalCatalogo" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <i class="fa fa-cubes">
                            </i> Catalogo de Productos
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="tile">
                            <div class="overlay p-5" id="divOverCatalogo">
                                <div class="m-loader mr-4">
                                    <svg class="m-circular" viewBox="25 25 50 50">
                                        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                    </svg>
                                </div>
                                <h4 class="l-text text-center text-white p-10" id="lblTextOverlayCatalogo">Cargando
                                    información...</h4>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <label>Marcas</label>
                                    <div class="form-group">
                                        <input id="cbMarcaModal" type="checkbox" checked>
                                        <label for="cbMarcaModal">Todas</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <label>Marca</label>
                                    <div class="form-group">
                                        <select id="cbSelectMarca" class="form-control" disabled>
                                            <option value="">- Seleccione -</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <label>Categorias</label>
                                    <div class="form-group">
                                        <input id="cbCategoriaModal" type="checkbox" checked>
                                        <label for="cbCategoriaModal">Todas</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <label>Categoria</label>
                                    <div class="form-group">
                                        <select id="cbSelectCategoria" class="form-control" disabled>
                                            <option value="">- Seleccione -</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <label>Presentaciones</label>
                                    <div class="form-group">
                                        <input id="cbPresentacionModal" type="checkbox" checked>
                                        <label for="cbPresentacionModal">Todas</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <label>Presentación</label>
                                    <div class="form-group">
                                        <select id="cbSelectPresentacion" class="form-control" disabled>
                                            <option value="">- Seleccione -</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <label>Unidades de Medida</label>
                                    <div class="form-group">
                                        <input id="cbUnidadMedidaModal" type="checkbox" checked>
                                        <label for="cbUnidadMedidaModal">Todas</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <label>Unidad de medida</label>
                                    <div class="form-group">
                                        <select id="cbSelectUnidadMedida" class="form-control" disabled>
                                            <option value="">- Seleccione -</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btnCatalogoShow">
                            <i class="text-danger fa fa-file-pdf-o"></i> Pdf</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="fa fa-close"></i> Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Productos <small>Lista</small></h1>
            </div>

            <div class="tile">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnAgregar">
                                <i class="fa fa-plus"></i>
                                Agregar
                            </button>
                            <button class="btn btn-secondary" id="btnReload">
                                <i class="fa fa-refresh"></i>
                                Recargar
                            </button>
                            <button class="btn btn-secondary" id="btnCatalogo">
                                <i class="fa fa-file-image-o"></i>
                                Catálogo
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/barcode.png" width="22" height="22"> Clave/ Clave Alterna(Enter): </label>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Clave o clave alterna" class="input-primary " id="txtClaveProducto">
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/search.svg" width="22" height="22"> Buscar por la Descripción:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Descripción del producto" class="input-primary" id="txtDescripcionProducto">
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/voluta.svg" width="22" height="22"> Categoría:</label>
                        <div class="form-group">
                            <select class="form-control" id="cbCategoria">
                                <option value="">- Seleccionar -</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/voluta.svg" width="22" height="22"> Marca:</label>
                        <div class="form-group">
                            <select class="form-control" id="cbMarca">
                                <option value="">- Seleccionar -</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-responsive">
                            <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                <thead class="table-header-background">
                                    <tr>
                                        <th style="width:5%">N°</th>
                                        <th style="width:20%">Descripción</th>
                                        <th style="width:10%">Categoría/Marca</th>
                                        <th style="width:10%">Costo</th>
                                        <th style="width:10%">Precio</th>
                                        <th style="width:10%">Impuesto</th>
                                        <th style="width:10%">Cantidad</th>
                                        <th style="width:10%">Imagen</th>
                                        <th colspan="2" style="width:10%">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12 text-center">
                        <label>Paginación</label>
                        <div class="form-group" id="ulPagination">
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-left"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-left"></i>
                            </button>
                            <span class="btn btn-outline-secondary disabled" id="lblPaginacion">0 - 0</span>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-right"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools();
            let state = false;
            let paginacion = 0;
            let opcion = 0;
            let totalPaginacion = 0;
            let filasPorPagina = 10;
            let tbList = $("#tbList");

            let idCategoria = 0;
            let idMarca = 0;

            let ulPagination = $("#ulPagination");

            $(document).ready(function() {
                $("#txtClaveProducto").keyup(function(event) {
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if ($(this).val().trim() != "") {
                            if (!state) {
                                paginacion = 1;
                                loadListaProductos(1, $(this).val().trim(), "", 0, 0);
                                opcion = 1;
                            }
                        }
                    }
                });

                $("#txtDescripcionProducto").keyup(function(event) {
                    console.log(event.keyCode);
                    if (event.keyCode !== 9 && event.keyCode !== 18 || event.keyCode !== 9) {
                        if ($(this).val().trim() != "") {
                            if (!state) {
                                paginacion = 1;
                                loadListaProductos(2, "", $(this).val().trim(), 0, 0);
                                opcion = 2;
                            }
                        }
                    }
                });

                $("#cbCategoria").change(function() {
                    if (!tools.validateComboBox($(this))) {
                        if (!state) {
                            paginacion = 1;
                            loadListaProductos(3, "", "", $(this).val(), 0);
                            opcion = 3;
                        }
                    }
                });

                $("#cbMarca").change(function() {
                    if (!tools.validateComboBox($(this))) {
                        if (!state) {
                            paginacion = 1;
                            loadListaProductos(4, "", "", 0, $(this).val());
                            opcion = 4;
                        }
                    }
                });

                $("#btnAgregar").click(function() {
                    window.location.href = "registrarproducto.php";
                });

                tools.keyEnter($("#btnAgregar"), function() {
                    window.location.href = "registrarproducto.php";
                });

                $("#btnReload").click(function() {
                    loadInitProductos();
                });

                tools.keyEnter($("#btnReload"), function() {
                    loadInitProductos();
                });

                $("#btnCatalogo").click(function(event) {
                    $("#modalCatalogo").modal("show");
                });

                tools.keyEnter($("#btnCatalogo"), function() {
                    $("#modalCatalogo").modal("show");
                });

                $("#modalCatalogo").on('shown.bs.modal', async function(e) {
                    onEventModalCalogo();
                });

                $("#modalCatalogo").on('hide.bs.modal', async function(e) {
                    $("#cbMarcaModal").prop('checked', true);
                    $("#cbCategoriaModal").prop('checked', true);
                    $("#cbPresentacionModal").prop('checked', true);
                    $("#cbUnidadMedidaModal").prop('checked', true);

                    $("#cbSelectMarca").prop('disabled', true);
                    $("#cbSelectMarca").prop('disabled', true);
                    $("#cbSelectMarca").prop('disabled', true);
                    $("#cbSelectMarca").prop('disabled', true);
                });

                $("#btnCatalogoShow").click(function() {
                    openPdfCatalogo();
                });

                tools.keyEnter($("#btnCatbtnCatalogoShowalogo"), function() {
                    openPdfCatalogo();
                });

                $("#cbMarcaModal").change(function() {
                    $("#cbSelectMarca").prop('disabled', $("#cbMarcaModal").is(":checked"));
                });

                $("#cbCategoriaModal").change(function() {
                    $("#cbSelectCategoria").prop('disabled', $("#cbCategoriaModal").is(":checked"));
                });

                $("#cbPresentacionModal").change(function() {
                    $("#cbSelectPresentacion").prop('disabled', $("#cbPresentacionModal").is(":checked"));
                });

                $("#cbUnidadMedidaModal").change(function() {
                    $("#cbSelectUnidadMedida").prop('disabled', $("#cbUnidadMedidaModal").is(":checked"));
                });

                loadInitProductos();
                loadCategoria();
                loadMarca();

            });

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        loadListaProductos(0, "", "", 0, 0);
                        break;
                    case 1:
                        loadListaProductos(1, $("#txtClaveProducto").val().trim(), "", 0, 0);
                        break;
                    case 2:
                        loadListaProductos(2, "", $("#txtDescripcionProducto").val().trim(), 0, 0);
                        break;
                    case 3:
                        loadListaProductos(3, "", "", $("#cbCategoria").val(), 0);
                        break;
                    case 4:
                        loadListaProductos(4, "", "", 0, $("#cbMarca").val());
                        break;
                }
            }

            function loadInitProductos() {
                if (!state) {
                    paginacion = 1;
                    loadListaProductos(0, "", "", 0, 0);
                    opcion = 0;
                }
            }

            async function loadListaProductos(opcion, clave, nombre, categoria, marca) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/SuministroController.php", {
                        "type": "listaproductos",
                        "opcion": opcion,
                        "clave": clave,
                        "nombre": nombre,
                        "categoria": categoria,
                        "marca": marca,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    }, function() {
                        tools.loadTable(tbList, 10);
                        state = true;
                        totalPaginacion = 0;
                    });

                    let object = result;
                    tbList.empty();

                    if (object.data.length == 0) {
                        tbList.append(
                            '<tr><td class="text-center" colspan="10"><p>No hay datos para mostrar.</p></td></tr>');
                        ulPagination.html(`
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-left"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-left"></i>
                            </button>
                            <span class="btn btn-outline-secondary disabled" id="lblPaginacion">0 - 0</span>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-right"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-right"></i>
                            </button>`);
                        state = false;
                    } else {

                        for (let suministro of object.data) {
                            let image = '<img src ="./images/image.svg" alt="' + suministro.NombreMarca + '"/>';
                            if (suministro.Imagen != "") {
                                image = '<img class="img-size-70" src ="' + ("./../resource/catalogo/" + suministro
                                    .Imagen) + '" alt="' + suministro.NombreMarca + '"/>';
                            } else {
                                if (suministro.NuevaImagen != '') {
                                    image = '<img class="img-size-70" src="' + "data:image/png;base64," + suministro
                                        .NuevaImagen + '" alt="Producto"/>';
                                }
                            }

                            let clave = suministro.Clave + " " + (suministro.ClaveAlterna == "" ? "" : " - " + suministro
                                .ClaveAlterna);
                            let cantidad = parseFloat(suministro.Cantidad) <= 0 ?
                                '<span class="text-xs-bold text-danger">' + tools.formatMoney(suministro.Cantidad) +
                                '<br>' + suministro.UnidadCompraNombre + '</span>' :
                                '<span class="text-xs-bold text-primary">' + tools.formatMoney(suministro.Cantidad) +
                                '<br>' + suministro.UnidadCompraNombre + '</span>';
                            tbList.append('<tr>' +
                                '<td class="text-center">' + suministro.Id + '</td>' +
                                '<td>' + clave + '<br>' + suministro.NombreMarca + '</td>' +
                                '<td>' + suministro.Categoria + '<br>' + suministro.Marca + '</td>' +
                                '<td class="text-right">' + tools.formatMoney(suministro.PrecioCompra) + '</td>' +
                                '<td class="text-right">' + tools.formatMoney(suministro.PrecioVentaGeneral) + '</td>' +
                                '<td class="text-right">' + suministro.ImpuestoNombre + '</td>' +
                                '<td class="text-left">' + cantidad + '</td>' +
                                '<td class="text-center">' + image + '</td>' +
                                '<td class="text-center">' +
                                '<a href="actualizarproducto.php?idSuministro=' + suministro.IdSuministro +
                                '" class="btn btn-warning"><i class="fa fa-edit"></i></a>' +
                                '</td>' +
                                '<td>' +
                                '<button type="button" class="btn btn-danger" onclick="removeProducto(\'' + suministro
                                .IdSuministro + '\')"><i class="fa fa-trash"></i></button>' +
                                '</td>' +
                                '</tr>');
                        }

                        totalPaginacion = parseInt(Math.ceil((parseFloat(object.total) / filasPorPagina)));

                        let i = 1;
                        let range = [];
                        while (i <= totalPaginacion) {
                            range.push(i);
                            i++;
                        }

                        let min = Math.min.apply(null, range);
                        let max = Math.max.apply(null, range);

                        let paginacionHtml = `
                            <button class="btn btn-outline-secondary" onclick="onEventPaginacionInicio(${min})">
                                <i class="fa fa-angle-double-left"></i>
                            </button>
                            <button class="btn btn-outline-secondary" onclick="onEventAnteriorPaginacion()">
                                <i class="fa fa-angle-left"></i>
                            </button>
                            <span class="btn btn-outline-secondary disabled" id="lblPaginacion">${paginacion} - ${totalPaginacion}</span>
                            <button class="btn btn-outline-secondary" onclick="onEventSiguientePaginacion()">
                                <i class="fa fa-angle-right"></i>
                            </button>
                            <button class="btn btn-outline-secondary" onclick="onEventPaginacionFinal(${max})">
                                <i class="fa fa-angle-double-right"></i>
                            </button>`;
                        ulPagination.html(paginacionHtml);
                        state = false;
                    }

                } catch (error) {
                    tbList.empty();
                    tools.loadTableMessage(tbList, tools.messageError(error), 10);
                    ulPagination.html(`
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-left"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-left"></i>
                            </button>
                            <span class="btn btn-outline-secondary disabled" id="lblPaginacion">0 - 0</span>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-right"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-right"></i>
                            </button>`);
                    state = false;
                }
            }

            async function loadCategoria() {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0006"
                    }, function() {
                        $("#cbCategoria").empty();
                    });

                    $("#cbCategoria").append('<option value="">- Seleccionar</option>');
                    for (let value of result) {
                        $("#cbCategoria").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                    }
                } catch (error) {
                    $("#cbCategoria").append('<option value="">- Seleccionar</option>');
                }
            }

            async function loadMarca() {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0007"
                    }, function() {
                        $("#cbMarcaModal").empty();
                    });

                    $("#cbMarcaModal").append('<option value="">- Seleccionar</option>');
                    for (let value of result) {
                        $("#cbMarcaModal").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                    }
                } catch (error) {
                    $("#cbMarcaModal").append('<option value="">- Seleccionar</option>');
                }
            }

            function onEventPaginacionInicio(value) {
                if (!state) {
                    if (value !== paginacion) {
                        paginacion = value;
                        onEventPaginacion();
                    }
                }
            }

            function onEventPaginacionFinal(value) {
                if (!state) {
                    if (value !== paginacion) {
                        paginacion = value;
                        onEventPaginacion();
                    }
                }
            }

            function onEventAnteriorPaginacion() {
                if (!state) {
                    if (paginacion > 1) {
                        paginacion--;
                        onEventPaginacion();
                    }
                }
            }

            function onEventSiguientePaginacion() {
                if (!state) {
                    if (paginacion < totalPaginacion) {
                        paginacion++;
                        onEventPaginacion();
                    }
                }
            }

            function removeProducto(IdSuministro) {
                tools.ModalDialog("Producto", '¿Está seguro de eliminar el Producto?', async function(value) {
                    if (value == true) {
                        try {
                            let result = await tools.promiseFetchPost(
                                "../app/controller/SuministroController.php", {
                                    "type": "removesuministro",
                                    "IdSuministro": IdSuministro
                                },
                                function() {
                                    tools.ModalAlertInfo("Producto", "Se está procesando la petición.");
                                });

                            tools.ModalAlertSuccess("Producto", result);
                            loadInitProductos();

                        } catch (error) {
                            tools.ErrorMessageServer("Productos", error);
                        }
                    }
                });
            }

            async function onEventModalCalogo() {
                try {
                    $("#cbSelectMarca").empty();
                    $("#cbSelectCategoria").empty();
                    $("#cbSelectPresentacion").empty();
                    $("#cbSelectUnidadMedida").empty();

                    let promiseFetchMarca = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0007"
                    });

                    let promiseFetchCategoria = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0006"
                    });

                    let promiseFetchPresentacion = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0008"
                    });

                    let promiseFetchUnidadMedida = await tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0013"
                    });

                    let promise = await Promise.all([
                        promiseFetchMarca,
                        promiseFetchCategoria,
                        promiseFetchPresentacion,
                        promiseFetchUnidadMedida
                    ]);
                    let result = await promise;

                    console.log(result)

                    let marca = result[0];
                    $("#cbSelectMarca").append('<option value="">- Seleccionar</option>');
                    for (let value of marca) {
                        $("#cbSelectMarca").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                    }

                    let categoria = result[1];
                    $("#cbSelectCategoria").append('<option value="">- Seleccionar</option>');
                    for (let value of categoria) {
                        $("#cbSelectCategoria").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                    }

                    let presentacion = result[2];
                    $("#cbSelectPresentacion").append('<option value="">- Seleccionar</option>');
                    for (let value of presentacion) {
                        $("#cbSelectPresentacion").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                    }

                    let unidadMedida = result[3];
                    $("#cbSelectUnidadMedida").append('<option value="">- Seleccionar</option>');
                    for (let value of unidadMedida) {
                        $("#cbSelectUnidadMedida").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                    }

                    $("#divOverCatalogo").addClass("d-none");
                } catch (error) {
                    console.log(error)
                    // $("#cbSelectMarca").append('<option value="">- Seleccionar</option>');
                }
            }

            function openPdfCatalogo() {
                if (!$("#cbMarcaModal").is(":checked") && tools.validateComboBox($("#cbSelectMarca"))) {
                    tools.AlertWarning("", "Seleccione la marca.");
                    $("#cbSelectMarca").focus();
                } else if (!$("#cbCategoriaModal").is(":checked") && tools.validateComboBox($("#cbSelectCategoria"))) {
                    tools.AlertWarning("", "Seleccione la categoría.");
                    $("#cbSelectCategoria").focus();
                } else if (!$("#cbPresentacionModal").is(":checked") && tools.validateComboBox($("#cbSelectPresentacion"))) {
                    tools.AlertWarning("", "Seleccione la presentación.");
                    $("#cbSelectPresentacion").focus();
                } else if (!$("#cbUnidadMedidaModal").is(":checked") && tools.validateComboBox($("#cbSelectUnidadMedida"))) {
                    tools.AlertWarning("", "Seleccione la unidad de medida.");
                    $("#cbSelectUnidadMedida").focus();
                } else {

                    let marca = $("#cbMarcaModal").is(":checked") ? 0 : $("#cbSelectMarca").val();
                    let categoria = $("#cbCategoriaModal").is(":checked") ? 0 : $("#cbSelectCategoria").val();
                    let presentacion = $("#cbPresentacionModal").is(":checked") ? 0 : $("#cbSelectPresentacion").val();
                    let unidadMedida = $("#cbUnidadMedidaModal").is(":checked") ? 0 : $("#cbSelectUnidadMedida").val();

                    let params = new URLSearchParams({
                        "marca": marca,
                        "categoria": categoria,
                        "presentacion": presentacion,
                        "unidad": unidadMedida
                    });

                    window.open("../app/sunat/pdfcatalogo.php?" + params, "_blank");
                }
            }
        </script>
    </body>

    </html>

<?php

}
