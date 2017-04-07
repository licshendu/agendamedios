<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>FIESTAS OAXACA</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?= base_url(); ?>utilerias/sb-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?= base_url(); ?>utilerias/sb-admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= base_url(); ?>utilerias/sb-admin/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="<?= base_url(); ?>utilerias/sb-admin/vendor/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?= base_url(); ?>utilerias/sb-admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery -->
        <script src='<?= base_url(); ?>utilerias/js/librerias/jquery-1.9.1.js'></script>
        <!--<script src="<?= base_url(); ?>utilerias/sb-admin/vendor/jquery/jquery.min.js"></script>-->

        <!-- Bootstrap Core JavaScript -->
        <script src="<?= base_url(); ?>utilerias/sb-admin/vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?= base_url(); ?>utilerias/sb-admin/vendor/metisMenu/metisMenu.js"></script>

        <!-- Morris Charts JavaScript -->
        <!--<script src="<?= base_url(); ?>utilerias/sb-admin/vendor/raphael/raphael.min.js"></script>-->
        <!--<script src="<?= base_url(); ?>utilerias/sb-admin/vendor/morrisjs/morris.min.js"></script>-->
        <!--<script src="<?= base_url(); ?>utilerias/sb-admin/data/morris-data.js"></script>-->

        <!-- Custom Theme JavaScript -->
        <script src="<?= base_url(); ?>utilerias/sb-admin/dist/js/sb-admin-2.js"></script>

        <!--jqgrid-->
        <link href="<?= base_url(); ?>utilerias/js/librerias/jqgrid/css/jquery-ui.css" rel="stylesheet" />
        <link href="<?= base_url(); ?>utilerias/js/librerias/jqgrid/css/ui.jqgrid.css" rel="stylesheet" />
        <script src="<?= base_url(); ?>utilerias/js/librerias/jqgrid/js/i18n/grid.locale-es.js"></script>
        <script src="<?= base_url(); ?>utilerias/js/librerias/jqgrid/js/jquery.jqGrid.src.js"></script>



        <!-- Kendo UI -->
        <link href="<?= base_url(); ?>utilerias/js/librerias/kendo-ui-v2014.1.318/styles/kendo.common.min.css" rel="stylesheet" />
        <link href="<?= base_url(); ?>utilerias/js/librerias/kendo-ui-v2014.1.318/styles/kendo.default.min.css" rel="stylesheet" />
        <link href="<?= base_url(); ?>utilerias/js/librerias/kendo-ui-v2014.1.318/styles/kendo.common-bootstrap.min.css" rel="stylesheet" />
        <link href="<?= base_url(); ?>utilerias/js/librerias/kendo-ui-v2014.1.318/styles/kendo.bootstrap.min.css" rel="stylesheet" />
        <link href="<?= base_url(); ?>utilerias/js/librerias/kendo-ui-v2014.1.318/styles/kendo.silver.min.css" rel="stylesheet" />
        <script src="<?= base_url(); ?>utilerias/js/librerias/kendo-ui-v2014.1.318/kendo.web.min.js"></script>
        <script src="<?= base_url(); ?>utilerias/js/librerias/kendo-ui-v2014.1.318/kendo.all.min.js"></script>
        <script src="<?= base_url(); ?>utilerias/js/librerias/kendo-ui-v2014.1.318/cultures/kendo.culture.es-MX.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>utilerias/js/librerias/kendo-ui-v2014.1.318/kendo.popup.min.js"></script>
        <script type="text/javascript">
            kendo.culture("es-MX");

            kendo.autoset = function (modelo, datos) {
//                console.log("en autoset");
                var propiedad, valor;

                function isValidDate(dateString) {
                    var regEx = /^\d{4}-\d{2}-\d{2}$/;
                    return dateString.match(regEx) != null;
                }

                for (propiedad in modelo) {
                    valor = datos[propiedad];
//                    console.log(propiedad + ":", valor);
                    if (typeof valor !== 'function' && propiedad !== 'uid'
                            && propiedad !== '_events' && valor !== undefined) {
//                        console.log(propiedad + ":", typeof valor);
//                        console.log('Es fecha: ', Date.parse(datos[propiedad]));
                        if (Array.isArray(valor)) {
                            modelo.set(propiedad, valor);
                        } else if (Date.parse(valor)) {
                            if (isValidDate(valor)) {
                                modelo.set(propiedad, new Date(valor + ' 00:00:00'));
                            } else {
                                console.warn(valor, "no es una fecha valida");
                            }
                        } else {
                            modelo.set(propiedad, valor);
                        }
                    }
                }
            };


            kendo.modeloToJSON = function (modelo) {
//                console.log("en modeloToJSON");
                var propiedad, valor, objeto = {};
                for (propiedad in modelo) {
                    valor = modelo.get(propiedad);

                    if ((typeof valor === 'string' || typeof valor === 'number' || typeof valor === 'boolean') && propiedad !== 'uid') {
                        objeto[propiedad] = (typeof valor === 'string') ? valor.toUpperCase() : valor;
                    } else if (valor === null) {
                        objeto[propiedad] = '';
                    } else if (typeof valor === "object") {
                        if (valor instanceof Date) {
                            objeto[propiedad] = kendo.toString(valor, "yyyy-MM-dd");
                        } else if (valor["value"] !== "" && valor["value"] !== undefined) {
                            objeto[propiedad] = valor.value;
                        } else {
                            try {
                                var objectoArray = JSON.parse(JSON.stringify(valor));
                                if (objectoArray instanceof Array) {
                                    objeto[propiedad] = objectoArray;
                                }
                            } catch (e) {
                                console.warn();
                            }
                        }
                    }
                }
                return objeto;
            };
        </script>

        <style>
            .form-control-kendo{
                width: 100% !important;
            }

            .clsDatePicker {
                z-index: 1050 !important;
            }

            input[readonly]{background-color: white !important; color: black !important; border-color: black !important}
            textarea, input[type="text"]  { text-transform: uppercase; }
            .ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {
                background: green;
                color: white;
            }

            /* Color of invalid field */
            .has-error .control-label,
            .help-block,
            .form-control-feedback.glyphicon-remove{
                color: #C9443E;
            }
            .form-control-feedback.glyphicon-ok{
                color: #3e8f3e;
            }
            .margen { margin-bottom: 8px; }
        </style>

        <!--bootbox-->
        <script src="<?= base_url(); ?>utilerias/js/librerias/bootbox.js"></script>

        <!--form validation-->
        <script src="<?= base_url(); ?>utilerias/js/librerias/formvalidation/js/formValidation.min.js"></script>
        <script src="<?= base_url(); ?>utilerias/js/librerias/formvalidation/js/framework/bootstrap.min.js"></script>

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">FIESTAS  DE OAXACA</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li>Bienvenid@ <?php echo $nombreUsuario; ?></li>                    
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a></li>
                            <!--<li><a href="#"><i class="fa fa-gear fa-fw"></i> Configurar</a></li>-->
                            <li class="divider"></li>
                            <li id="logout"><a href="login"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <!--MENU IZQUIERDA-->
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <?php foreach ($menu as $registro): ?>
                                <li>
                                    <a><i class="fa fa-sitemap fa-fw"></i><?php echo $registro['menu']; ?><span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <?php foreach ($registro['opciones'] as $opcion): ?>
                                            <li>
                                                <a href="<?php echo $opcion['url']; ?>"><?php echo $opcion['opcion']; ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>

                                </li>
                            <?php endforeach; ?>


                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $titulo; ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <?php echo $pagina; ?>

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

    </body>

</html>
