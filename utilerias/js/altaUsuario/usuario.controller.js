usuarioModulo = (function (window, undefined) {
    var pb = {}, pv = {};
    pb.defaults = {};
    pb.usuario = kendo.observable(usuarioModelo);
    pb.gridUsuarios = function (parametros) {
        try {
            console.info("--gridUsuarios");
            $("#gridUsuarios").jqGrid("GridUnload");
            $("#gridUsuarios").jqGrid({
                url: "listarUsuarios",
                //postData: criterios,
                mtype: "POST",
                datatype: "json",
                colNames: ['', '', 'USUARIO', 'NOMBRE', 'PRIMER APELLIDO', 'SEGUNDO APELLIDO'],
                colModel: [
                    {name: '', align: "center", width: 15, search: false, sortable: false,
                        formatter: function (cellValue, option, rowObject) {
                            var botones = "";
                            botones += "<button type='button' class='btnpt btn-ptabla editar' title='Editar'><i class='fa fa-list-alt' aria-hidden='true'></i></button>";
//                            botones += "<button type='button' class='btnpt btn-ptabla cambiarContrasenia' title='Cambiar contraseña'><i class='fa fa-picture-o' aria-hidden='true'></i></button>";
                            return botones;
                        }
                    },
                    {name: 'id_usuario', width: 1, search: false, hidden: true},
                    {name: 'usuario', width: 150, search: false},
                    {name: 'nombre', width: 100, search: false},
                    {name: 'primer_apellido', width: 200, search: false},
                    {name: 'segundo_apellido', width: 100, search: false}
                ],
                multiselect: false,
                height: 500,
                autowidth: true,
                rowNum: 20,
                sortname: 'primer_apellido',
                rowList: [20, 40, 60],
                pager: "#pagerUsuarios",
                viewrecords: true,
                ignoreCase: true,
                shrinkToFit: false,
                forceFit: true,
                loadComplete: function (data) {
                    console.log("gridComplete");
                }

            });

            $("#gridUsuarios").jqGrid('filterToolbar', {stringResult: true, defaultSearch: 'cn'});
            $("#gridUsuarios").jqGrid("navGrid", "#pagerUsuarios", {search: false, add: false, edit: false, del: false});
            $("#gridUsuarios").jqGrid('setGridWidth', $('#contUsuarios').width());

            $(window).resize(function () {
                console.info("-----rezise--");
                $("#gridUsuarios").jqGrid('setGridWidth', $('#contUsuarios').width());
            });

        } catch (e) {
            console.warn(e);
        }
    };
    return pb;
})(window);


$(function () {

    usuarioModulo.defaults.usuario = $.extend({}, usuarioModulo.usuario);
    kendo.bind($("#alta-usuario"), usuarioModulo.usuario);

    $("#btnNuevoUsuario").click(function () {
        kendo.autoset(usuarioModulo.usuario, usuarioModulo.defaults.usuario);
        validacion.resetForm();
        $("#altaUsuarioModal").modal('show');
    })

    $("#btnRegistrarUsuario").click(function () {
        console.log("btnRegistrarUsuario");
        validacion.validate();
        if (validacion.isValid()) {
            $.ajax({
                type: "POST",
                url: "registrarUsuario",
                data: {datos: kendo.modeloToJSON(usuarioModulo.usuario)},
                success: function (data) {
                    usuarioModulo.gridUsuarios();
                    $("#altaUsuarioModal").modal('hide');
                },
                dataType: "html",
                async: false
            });
        }
    });

    $(document).on('click', '.editar', function () {
        var selRowId = $("#gridUsuarios").jqGrid('getGridParam', 'selrow');
        var data = $("#gridUsuarios").jqGrid('getRowData', selRowId);
//        console.log(data);
        $.ajax({
            type: "POST",
            url: "consultarUsuario",
            data: {id_usuario: data.id_usuario},
            success: function (data) {
                kendo.autoset(usuarioModulo.usuario, data);
                $("#altaUsuarioModal").modal('show');
            },
            dataType: "json",
            async: false
        });
    });

    usuarioModulo.gridUsuarios();

});