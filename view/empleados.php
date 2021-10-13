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

        <!-- modal proceso empleado -->
        <div class="row">
            <div class="modal fade" id="modalProcesoEmpleado" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">
                                <i class="fa fa-users"></i> Nuevo/Editar empleado
                            </h4>
                            <button type="button" class="close" id="btnCloseModalProcesoEmpleado">
                                <i class="fa fa-window-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="tile">
                                <div class="tile-body">
                                    <ul class="nav nav-tabs mb-2" role="tablist">
                                        <li class="nav-item">
                                            <a id="navDatosBasicos" class="nav-link active" href="#datosBasicos" role="tab" data-toggle="tab"> Datos basicos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="navDatosContacto" class="nav-link" href="#datosContacto" role="tab" data-toggle="tab"> Datos de contacto</a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="navAccesoSistema" class="nav-link" href="#accesoSistema" role="tab" data-toggle="tab"> Acceso al sistema</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">

                                        <div role="tabpanel" class="tab-pane fade in active show" id="datosBasicos">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Tipo documento <i class="fa fa-info-circle text-danger"></i></label>
                                                        <select id="cbxTipDocumentoEmpleado" class="form-control">
                                                            <option value="">--selected--</option>
                                                            <option value="1">OPCIÓN 1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>N° documento <i class="fa fa-info-circle text-danger"></i></label>
                                                        <input id="txtNumDocumentoEmpleado" type="text" class="form-control" placeholder="Número de documento">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Apellidos <i class="fa fa-info-circle text-danger"></i></label>
                                                        <input id="txtApellidosEmpleado" type="text" class="form-control" placeholder="Apellidos de empleado">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Nombres <i class="fa fa-info-circle text-danger"></i></label>
                                                        <input id="txtNombresEmpleado" type="text" class="form-control" placeholder="Nombres de empleado">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Sexo </label>
                                                        <select id="cbxSexoEmpleado" class="form-control">
                                                            <option value="">--selected--</option>
                                                            <option value="1">OPCIÓN 1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Fecha Nacimiento </label>
                                                        <input id="dtFechaNacimientoEmpleado" type="date" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Puesto </label>
                                                        <select id="cbxPuestoEmpleado" class="form-control">
                                                            <option value="">--selected--</option>
                                                            <option value="1">OPCIÓN 1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Estado </label>
                                                        <select id="cbxEstadoEmpleado" class="form-control">
                                                            <option value="">--selected--</option>
                                                            <option value="1">OPCIÓN 1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="datosContacto">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Telefono </label>
                                                        <input id="txtTelefonoEmpleado" type="text" class="form-control" placeholder="Numero de telefono de empleado">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Celular </label>
                                                        <input id="txtCelularEmpleado" type="text" class="form-control" placeholder="Numero de celular de empleado">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Email </label>
                                                        <input id="txtEmailEmpleado" type="text" class="form-control" placeholder="Email de empleado">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Dirección </label>
                                                        <input id="txtDireccionEmpleado" type="text" class="form-control" placeholder="Dirección de empleado">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="accesoSistema">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center p-3">
                                                            <img src="./images/noimage.jpg" id="lblImagen" class="img-fluid" style="object-fit: cover;" width="100" height="100">
                                                        </div>
                                                        <div class="col-md-12 text-center">
                                                            <input id="fileImage" type="file" accept="image/png, image/jpeg, image/gif, image/svg" style="display: none" />
                                                            <label for="fileImage" id="txtFile" class="btn btn-warning"><i class="fa fa-photo"></i> Subir Imagen</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Usuario <i class="fa fa-info-circle text-danger"></i></label>
                                                        <input id="txtUsuarioEmpleado" type="text" class="form-control" placeholder="Usuario de empleado">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Contraseña <i class="fa fa-info-circle text-danger"></i></label>
                                                        <input id="txtPasswordEmpleado" type="password" class="form-control" placeholder="Contraseña de empleado">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Rol <i class="fa fa-info-circle text-danger"></i></label>
                                                        <select id="cbxRolEmpleado" class="form-control">
                                                            <option value="">--selected--</option>
                                                            <option value="1">OPCIÓN 1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label class="text-danger">Todos los campos marcados con <i class="fa fa-info-circle"></i> son necesaris rellenar.</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="text-right">
                                        <div class="form-group">
                                            <button id="btnAceptarProcesoEmpleado" class="btn btn-info" type="button" title="Aceptar"><i class="fa fa-save"></i> Aceptar</button>
                                            <button id="btnCancelarProcesoEmpleado" class="btn btn-danger" type="button" title="Cancelar"><i class="fa fa-close"></i> Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-users"></i> Empleados</h1>
                <!-- <div>
                    <button id="btnNuevoEmpleado" class="btn btn-success" title="Nuevo empleado">
                        <i class="fa fa-plus"></i> Nuevo
                    </button>
                    <button id="btnRecargarEmpleado" class="btn btn-secondary" title="Recargar lista de empleados">
                        <i class="fa fa-refresh"></i> Recargar
                    </button>
                </div> -->
            </div>

            <div class="tile mb-4">

                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button id="btnNuevoEmpleado" class="btn btn-success" title="Nuevo empleado">
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                            <button id="btnRecargarEmpleado" class="btn btn-secondary" title="Recargar lista de empleados">
                                <i class="fa fa-refresh"></i> Recargar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Buscar por dni, apellido o nombre</label>
                            <input id="txtSearchEmpleado" type="search" class="form-control" placeholder="Buscar...">
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                <thead style="background-color: #0766cc;color: white;">
                                    <tr>
                                        <th class="sorting" style="width: 10%;">N°</th>
                                        <th class="sorting" style="width: 20%;">Documento</th>
                                        <th class="sorting" style="width: 20%;">Datos completos</th>
                                        <th class="sorting" style="width: 20%;">Tel./cel.</th>
                                        <th class="sorting" style="width: 20%;">Rol</th>
                                        <th class="sorting" style="width: 10%;">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="tbListEmpleados">
                                    <tr>
                                        <td class="text-center" colspan="6">Tabla sin contenido</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="text-right">
                            <div class="form-group">
                                <button id="btnAnterioEmpleado" class="btn btn-info" title="Anterior">
                                    <i class="fa fa-arrow-circle-left"></i>
                                </button>
                                <span id="lblPaginaActualEmpleado" class="m-2">0
                                </span>
                                <span class="m-2">
                                    de
                                </span>
                                <span id="lblPaginaSiguienteEmpleado" class="m-2">0
                                </span>
                                <button id="btnSiguienteEmpleado" class="btn btn-info" title="Siguiente">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools()

            let btnNuevoEmpleado = $("#btnNuevoEmpleado")
            let modalProcesoEmpleado = $("#modalProcesoEmpleado")
            let btnCloseModalProcesoEmpleado = $("#btnCloseModalProcesoEmpleado")
            let btnCancelarProcesoEmpleado = $("#btnCancelarProcesoEmpleado")

            let cbxTipDocumentoEmpleado = document.getElementById("cbxTipDocumentoEmpleado")
            let txtNumDocumentoEmpleado = $("#txtNumDocumentoEmpleado")
            let txtApellidosEmpleado = $("#txtApellidosEmpleado")
            let txtNombresEmpleado = $("#txtNombresEmpleado")
            let cbxSexoEmpleado = document.getElementById("cbxSexoEmpleado")
            let dtFechaNacimientoEmpleado = document.getElementById("dtFechaNacimientoEmpleado")
            let cbxPuestoEmpleado = document.getElementById("cbxPuestoEmpleado")
            let cbxEstadoEmpleado = document.getElementById("cbxEstadoEmpleado")
            let txtTelefonoEmpleado = $("#txtTelefonoEmpleado")
            let txtCelularEmpleado = $("#txtCelularEmpleado")
            let txtEmailEmpleado = $("#txtEmailEmpleado")
            let txtDireccionEmpleado = $("#txtDireccionEmpleado")
            let txtUsuarioEmpleado = $("#txtUsuarioEmpleado")
            let txtPasswordEmpleado = $("#txtPasswordEmpleado")
            let cbxRolEmpleado = document.getElementById("cbxRolEmpleado")

            let navDatosBasicos = $("#navDatosBasicos")
            let navDatosContacto = $("#navDatosContacto")
            let navAccesoSistema = $("#navAccesoSistema")

            let datosBasicos = $("#datosBasicos")
            let datosContacto = $("#datosContacto")
            let accesoSistema = $("#accesoSistema")


            $(document).ready(function() {

                btnNuevoEmpleado.click(function() {
                    modalProcesoEmpleado.modal('show')
                })

                modalProcesoEmpleado.on("shown.bs.modal", function(e) {
                    dtFechaNacimientoEmpleado.valueAsDate = new Date()
                })

                btnCloseModalProcesoEmpleado.click(function() {
                    modalProcesoEmpleado.modal('hide')
                    clearModalProcesoEmpleado()
                })

                btnCancelarProcesoEmpleado.click(function() {
                    modalProcesoEmpleado.modal('hide')
                    clearModalProcesoEmpleado()
                })


            })

            function clearModalProcesoEmpleado() {
                cbxTipDocumentoEmpleado.selectedIndex = '0'
                txtNumDocumentoEmpleado.val('')
                txtApellidosEmpleado.val('')
                txtNombresEmpleado.val('')
                cbxSexoEmpleado.selectedIndex = '0'
                dtFechaNacimientoEmpleado.valueAsDate = new Date();
                cbxPuestoEmpleado.selectedIndex = '0'
                cbxEstadoEmpleado.selectedIndex = '0'
                txtTelefonoEmpleado.val('')
                txtCelularEmpleado.val('')
                txtEmailEmpleado.val('')
                txtDireccionEmpleado.val('')
                txtUsuarioEmpleado.val('')
                txtPasswordEmpleado.val('')
                cbxRolEmpleado.selectedIndex = '0'

                navDatosBasicos.removeClass("active")
                navDatosBasicos.removeClass("active")
                navAccesoSistema.removeClass("active")
                navDatosBasicos.addClass("active")

                datosBasicos.removeClass("in active show")
                datosContacto.removeClass("in active show")
                accesoSistema.removeClass("in active show")
                datosContacto.addClass("in active show")
            }
        </script>
    </body>

    </html>

<?php

}
