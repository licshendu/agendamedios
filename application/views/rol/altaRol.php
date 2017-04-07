<script src="<?= base_url(); ?>utilerias/js/altaRol/rol.validacion.js"></script>
<script src="<?= base_url(); ?>utilerias/js/altaRol/rol.model.js"></script>
<script src="<?= base_url(); ?>utilerias/js/altaRol/rol.controller.js"></script>

<div class="container-fluid">

    <div class="row">
        <button class="btn btn-primary" id="btnAltaRol" name="btnAltaRol">
            <i class="fa fa-check"></i>&nbsp;Alta rol
        </button>
    </div>

    <div class="row">
        <!--GRID Roles-->
        <div id="contRoles">
            <div class="form-group">
                <table id="gridRoles"></table>
                <div id="pagerRoles"></div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="formRolModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestionar Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row" id="alta-rol">
                    <div class="col-md-12" id="alta-usuario">
                        <div class="row margen">
                            <label class="col-md-4 control-label" for="rol"><i class="fa fa-newspaper-o"></i>&nbsp;rol</label>
                            <div class="col-md-6">
                                <input id="rol" name="rol" type="text"
                                       data-bind="value: rol, enabled:enab.rol, invisible: inv.rol" placeholder="rol"
                                       class="form-control input-md" />
                            </div>
                        </div>

                        <div class="row margen">
                            <label class="col-md-4 control-label" for="opciones"><i class="fa fa-newspaper-o"></i>&nbsp;Opciones</label>
                            <div class="col-md-6">
                                <select id="opciones" name="opciones" class="form-control-kendo" placeholder="opciones"
                                        data-role="multiselect"
                                        data-text-field="label"
                                        data-value-field="value"
                                        data-bind="value: opciones,source: src.opciones"
                                        /></select>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">

                <button class="btn btn-primary" id="btnRegistrarRol" name="btnRegistrarRol">
                    <i class="fa fa-check"></i>&nbsp;Guardar
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>