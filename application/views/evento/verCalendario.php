<link href='<?= base_url(); ?>utilerias/js/librerias/fullcalendar-3.1.0/fullcalendar.min.css' rel='stylesheet' />
<link href='<?= base_url(); ?>utilerias/js/librerias/fullcalendar-3.1.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='<?= base_url(); ?>utilerias/js/librerias/fullcalendar-3.1.0/lib/moment.min.js'></script>
<!--<script src='<?= base_url(); ?>utilerias/js/librerias/fullcalendar-3.1.0/lib/jquery.min.js'></script>-->
<script src='<?= base_url(); ?>utilerias/js/librerias/fullcalendar-3.1.0/fullcalendar.min.js'></script>
<script src='<?= base_url(); ?>utilerias/js/librerias/fullcalendar-3.1.0/locale/es.js'></script>

<script src='<?= base_url(); ?>utilerias/js/calendario/calendario.controller.js'></script>
<link href='<?= base_url(); ?>utilerias/css/calendario.css' rel='stylesheet' />

<div class="container-fluid">
    <div class="row">
        <div class="col-md-7">
            <div  id='calendario'></div>
        </div>
        <div class="col-md-4" id="ficha-Evento">
            <div class="row">
                <img  style="width:100%; height:100%;" src="<?= base_url(); ?>utilerias/imagenes/a8e0a4201714111f7224cbc136888e5c.jpg"/>
            </div>
            <div class="row">
                <div class="col-md-12" id="titulo">
                    <center>
                        <label data-bind="text: title, enabled:enabled">Nombre Evento</label>
                    </center>
                </div>
            </div>

            <div class="row">

                <div class="col-md-2">
                    <label for="fechaInicioEvento">Del:</label>
                </div>

                <div class="col-md-4">
                    <input id="fechaInicioEvento" name="fechaInicioEvento" 
                           data-role="datepicker" 
                           data-readonly ="true"
                           data-bind="value: fecha_inicio, enabled: enabled"
                           type="text" placeholder="Fecha Fiesta" class="form-control-kendo" />
                </div>
                <div class="col-md-2">
                    <label for="fechaInicioEvento">Al:</label>
                </div>
                <div class="col-md-4">
                    <input id="fechaInicioEvento" name="fechaInicioEvento" 
                           data-role="datepicker" 
                           data-readonly ="true"
                           data-bind="value: fecha_fin, enabled:enabled"
                           type="text" placeholder="Fecha Fiesta" class="form-control-kendo" />
                </div>
            </div>

            <div class="row">
                <div id="descripcion" data-bind="text: descripcion"></div>
            </div>

        </div>
    </div>
</div>