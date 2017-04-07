var altaEvento = kendo.observable({
    idRegion: "",
    regiones: new kendo.data.DataSource({
        type: "json",
        serverFiltering: true,
        transport: {
            read: {
                url: "getRegiones",
                async: true,
                data: {}
            }
        }
    }),
    changeRegion: function () {
        var itemSeleccionado = $("#region").data("kendoComboBox").dataItem();
        if (itemSeleccionado !== undefined) {
            this.distritos.read();
            this.set('enab.distrito', true);
        } else {
            this.set('idRegion', "");
            this.set('enab.distrito', false);
        }
    },
    idDistrito: "",
    distritos: new kendo.data.DataSource({
        type: "json",
        serverFiltering: true,
        transport: {
            read: {
                url: "getDistritos",
                async: true,
                data: function () {
                    return {idRegion: altaEvento.get('idRegion')}
                }
            }
        }
    }),
    changeDistrito: function () {

    },
    idMunicipio: null,
    municipios: new kendo.data.DataSource({
        type: "json",
        schema: {
            model: {
                id: 'value'
            }
        },
        serverFiltering: true,
        transport: {
            read: {
                url: "getMunicipios",
                async: true,
                data: function () {
                    var parametros = {};
                    if (altaEvento.get('idRegion') !== '' && altaEvento.get('idDistrito') !== '') {
                        parametros.idRegion = altaEvento.get('idRegion');
                        parametros.idDistrito = altaEvento.get('idDistrito');
                    }
                    return parametros;
                }
            }
        }
    }),
    changeMunicipio: function () {
    },
    nombre: '',
    descripcion: '',
    fechaInicio: '',
    fechaFin: '',
    registrarEvento: function () {
        $('#altaEvento').data("formValidation").resetForm();
        $('#altaEvento').data("formValidation").validate();
        if ($('#altaEvento').data("formValidation").isValid() === true) {
            $.ajax({
                type: "POST"
                , dataType: "json"
                , encoding: "utf-8"
                , contentType: "application/x-www-form-urlencoded"
                , url: "registrarEvento"
                , async: false
                , data: {
                    datos: kendo.modeloToJSON(altaEvento)
                }
            }).done(function () {
                console.log("--done--");
                $("#grid").data("kendoGrid").dataSource.read();
            });
        }

    },
    enab: {
        region: true,
        distrito: false,
        municipio: true,
        agregarEvento: true
    }
});

$(function () {
    console.log("-- alta evento--");

    kendo.bind($("#altaEvento"), altaEvento);

    $("#grid").kendoGrid({
        dataSource: {
            type: "json",
            transport: {
                read: "listarEventos"
            },
            schema: {
                model: {
                    fields: {
                        evento: {type: "string"},
                        descripcion: {type: "string"},
                        fecha_inicio: {type: "date"},
                        fecha_fin: {type: "date"},
                        region: {type: "string"},
                        distrito: {type: "string"},
                        municipio: {type: "string"},
                        usuario: {type: "string"},
                        fecha_alta: {type: "date"},
                        estatus: {type: "string"}
                    }
                }
            },
            pageSize: 20,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true
        },
        height: 550,
        filterable: true,
        sortable: true,
        pageable: true,
        columns: [
            {field: "evento", title: "Evento", width: "15%"},
            {field: "descripcion", title: "Descripcion", width: "25%"},
            {field: "fecha_inicio", title: "Inicia", format: "{0:M}", width: "10%"},
            {field: "fecha_fin", title: "Termina", format: "{0:M}", width: "10%"},
//            {field: "region", title: "Region", width: "10%"},
//            {field: "distrito", title: "Distrito"},
            {field: "municipio", title: "Municipio"},
            {field: "usuario", title: "Usuario", width: "10%"},
            {field: "fecha_alta", title: "Alta", format: "{0:MM/dd/yyyy h:mm:ss}", width: "10%"},
            {field: "estatus", title: "Estatus", width: "10%"}
        ]
    });

    validacion = $('#altaEvento').formValidation({
        framework: 'bootstrap',
//        excluded: ':disabled',
        icon: {
//            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            municipio: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el Municipio'
                    }
                }
            },
            nombreEvento: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese nombre del evento'
                    }
                }
            },
            descripcion: {
                validators: {
                    notEmpty: {
                        message: 'por favor ingrese una descripcion'
                    }
                }
            },
            fechaEvento: {
                validators: {
                    notEmpty: {
                        message: 'ingrese fecha del evento'
                    }
                }
            }
        }
    }).data().formValidation;

    $("#logout").click(function () {
        $.ajax({
            type: "POST"
            , dataType: "json"
            , encoding: "utf-8"
            , contentType: "application/x-www-form-urlencoded"
            , url: "logout"
            , async: false
            , data: {}
        }).done(function(respuesta){
            window.location.href = "";
        });
    });

});