<link href='<?= base_url(); ?>utilerias/css/alta/altaEvento.css' rel='stylesheet' />
<script src="<?= base_url(); ?>utilerias/js/altaEvento/altaEvento.js"></script>

<div class="container-fluid" id="altaEvento">

    <div class="row">
        <div class="col-md-8">
            <div id="grid"></div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <label class="col-md-4 control-label text-left" for="region">Region</label>
                <div class="col-md-6">
                    <select id="region" name="region" class="form-control-kendo" placeholder="REGION"
                            data-role="combobox"
                            data-text-field="text"
                            data-value-field="value"
                            data-bind="value: idRegion,source: regiones, enabled: enab.region, events:{change: changeRegion}"
                            /></select>
                </div>
            </div>

            <div class="row" id="form_alta">
                <label class="col-md-4 control-label text-left" for="distrito">Distrito</label>
                <div class="col-md-6">
                    <select id="distrito" name="distrito" class="form-control-kendo" placeholder="DISTRITO"
                            data-role="combobox"
                            data-text-field="label"
                            data-value-field="value"
                            data-auto-bind="false"
                            data-bind="value: idDistrito,source: distritos, enabled: enab.distrito, events:{change: changeDistrito}"
                            /></select>
                </div>
            </div>

            <div class="row">
                <label class="col-md-4 control-label text-left" for="municipio">Municipio</label>
                <div class="col-md-6">
                    <select id="municipio" name="municipio" class="form-control-kendo" placeholder="MUNICIPIO"
                            data-role="combobox"
                            data-text-field="label"
                            data-value-field="value"
                            data-auto-bind="false"
                            data-filter="true"
                            data-min-length ="3"
                            data-bind="value: idMunicipio,source: municipios, enabled: enab.municipio,
                            events:{change: changeMunicipio}"
                            ></select>
                </div>
            </div>

            <div class="row">
                <label class="col-md-4 control-label" for="nombreEvento"><i class="fa fa-newspaper-o"></i>&nbsp;Nombre del Fiesta</label>
                <div class="col-md-6">
                    <input id="nombreEvento" name="nombreEvento" type="text"
                           data-bind="value: nombre" placeholder="Nombre fiesta"
                           class="form-control input-md" />
                </div>
            </div>

            <div class="row">
                <textarea placeholder="descripcion del fiesta..." id="descripcion" name="descripcion" cols="70" rows="10"
                          data-bind="value:descripcion"></textarea>
            </div> 

            <div class="row">
                <label class="col-md-4 control-label text-left" for="fechaInicioEvento"><i class="fa fa-calendar"></i>&nbsp;Fecha Inicio</label>
                <div class="col-md-4">
                    <input id="fechaInicioEvento" name="fechaInicioEvento" 
                           data-role="datepicker" 
                           data-readonly ="true"
                           data-bind="value:fechaInicio"
                           type="text" placeholder="Fecha Fiesta" class="form-control-kendo" />
                </div>
            </div>

            <div class="row">
                <label class="col-md-4 control-label text-left" for="fechaFinEvento"><i class="fa fa-calendar"></i>&nbsp;Fecha Fin</label>
                <div class="col-md-4">
                    <input id="fechaFinEvento" name="fechaFinEvento" 
                           data-role="datepicker" 
                           data-readonly ="true"
                           data-bind="value:fechaFin"
                           type="text" placeholder="Fecha Fiesta" class="form-control-kendo" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-primary" id="btnAgregarEvento" name="btnAgregarEvento" type="button"
                            data-bind="enabled: enab.agregarEvento, events:{click:registrarEvento}">
                        <i class="fa fa-check"></i>&nbsp;Agregar Fiesta</button>
                </div>
            </div>
        </div>
    </div>

</div>
