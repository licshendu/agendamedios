<script src="<?= base_url(); ?>utilerias/js/altaUsuario/usuario.validacion.js"></script>
<script src="<?= base_url(); ?>utilerias/js/altaUsuario/usuario.model.js"></script>
<script src="<?= base_url(); ?>utilerias/js/altaUsuario/usuario.controller.js"></script>

<div class="container-fluid">
    <div class="row margen">

    </div>

    <div class="row">
        <button class="btn btn-primary" id="btnNuevoUsuario" name="btnNuevoUsuario">
            <i class="fa fa-check"></i>&nbsp;Nuevo Usuario
        </button>
    </div>
    <div class="row">
        <!--GRID USUARIOS-->
        <div id="contUsuarios">
            <div class="form-group">
                <table id="gridUsuarios"></table>
                <div id="pagerUsuarios"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="altaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestionar Usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12" id="alta-usuario">
                        <div class="row margen">
                            <label class="col-md-4 control-label" for="usuario"><i class="fa fa-newspaper-o"></i>&nbsp;usuario</label>
                            <div class="col-md-6">
                                <input id="usuario" name="usuario" type="text"
                                       data-bind="value: usuario, enabled:enab.usuario, invisible: inv.usuario, events:{change: chg.Usuario}" placeholder="usuario"
                                       class="form-control input-md" />
                            </div>
                        </div>
                        <div class="row margen">
                            <label class="col-md-4 control-label" for="contrasenia"><i class="fa fa-newspaper-o"></i>&nbsp;contraseña</label>
                            <div class="col-md-6">
                                <input id="contrasenia" name="contraseña" type="text"
                                       data-bind="value: contrasenia, enabled:enab.contrasenia, invisible: inv.contrasenia, events:{change: chg.Contrasenia}" placeholder="contrasenia"
                                       class="form-control input-md" />
                            </div>
                        </div>
                        <div class="row margen">
                            <label class="col-md-4 control-label" for="nombre"><i class="fa fa-newspaper-o"></i>&nbsp;nombre</label>
                            <div class="col-md-6">
                                <input id="nombre" name="nombre" type="text"
                                       data-bind="value: nombre, enabled:enab.nombre, invisible: inv.nombre, events:{change: chg.Nombre}" placeholder="nombre"
                                       class="form-control input-md" />
                            </div>
                        </div>
                        <div class="row margen">
                            <label class="col-md-4 control-label" for="primer_apellido"><i class="fa fa-newspaper-o"></i>&nbsp;primer apellido</label>
                            <div class="col-md-6">
                                <input id="primer_apellido" name="primer_apellido" type="text"
                                       data-bind="value: primer_apellido, enabled:enab.primer_apellido, invisible: inv.primer_apellido, events:{change: chg.Primer_apellido}" placeholder="primer apellido"
                                       class="form-control input-md" />
                            </div>
                        </div>
                        <div class="row margen">
                            <label class="col-md-4 control-label" for="segundo_apellido"><i class="fa fa-newspaper-o"></i>&nbsp;segundo apellido</label>
                            <div class="col-md-6">
                                <input id="segundo_apellido" name="segundo_apellido" type="text"
                                       data-bind="value: segundo_apellido, enabled:enab.segundo_apellido, invisible: inv.segundo_apellido, events:{change: chg.Segundo_apellido}" placeholder="segundo apellido"
                                       class="form-control input-md" />
                            </div>
                        </div>

                        <div class="row margen">
                            <label class="col-md-4 control-label" for="roles"><i class="fa fa-newspaper-o"></i>&nbsp;Roles</label>
                            <div class="col-md-6">
                                <select id="roles" name="roles" class="form-control-kendo"
                                        data-role="multiselect"
                                        data-text-field="label"
                                        data-value-field="value"
                                        data-bind="value: roles,source: src.roles"
                                        /></select>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btnRegistrarUsuario" name="btnRegistrarUsuario">
                    <i class="fa fa-check"></i>&nbsp;Guardar
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
