rolModulo = (function (window, undefined) {
    var pb = {}, pv = {};
    pb.defaults = {};
    pb.rol = kendo.observable(rolModelo);
    pb.gridRoles = function (parametros) {
        try {
            console.log("--gridRoles");
            $("#gridRoles").jqGrid("GridUnload");
            $("#gridRoles").jqGrid({
                url: "listarRolesGrid",
                //postData: criterios,
                mtype: "POST",
                datatype: "json",
                colNames: ['','', 'ROL', 'FECHA ALTA'],
                colModel: [
                    {name: '', align: "center", width: 15, search: false, sortable: false,
                        formatter: function (cellValue, option, rowObject) {
                            var botones = "";
                            botones += "<button type='button' class='btnpt btn-ptabla editar' title='Editar'><i class='fa fa-list-alt' aria-hidden='true'></i></button>";
                            return botones;
                        }
                    },
                    {name: 'id_rol', width: 150, search: false, hidden: true},
                    {name: 'rol', width: 150, search: false},
                    {name: 'fecha_alta', width: 100, search: false},
                ],
                multiselect: false,
                height: 500,
                autowidth: true,
                rowNum: 20,
                sortname: 'rol',
                rowList: [20, 40, 60],
                pager: "#pagerRoles",
                viewrecords: true,
                ignoreCase: true,
                shrinkToFit: false,
                forceFit: true,
                loadComplete: function (data) {
                    console.log("gridComplete");
                }

            });

            $("#gridRoles").jqGrid('filterToolbar', {stringResult: true, defaultSearch: 'cn'});
            $("#gridRoles").jqGrid("navGrid", "#pagerRoles", {search: false, add: false, edit: false, del: false});
            $("#gridRoles").jqGrid('setGridWidth', $('#contRoles').width());

            $(window).resize(function () {
                console.info("-----rezise--");
                $("#gridRoles").jqGrid('setGridWidth', $('#contRoles').width());
            });

        } catch (e) {
            console.warn(e);
        }
    };
    return pb;
})(window);


$(function () {

    rolModulo.defaults.rol = $.extend({}, rolModulo.rol);
    kendo.bind($("#alta-rol"), rolModulo.rol);

    $("#btnAltaRol").click(function () {
        console.info("--btnAltaRol--");
        kendo.autoset(rolModulo.rol, rolModulo.defaults.rol);
        validacion.resetForm();
        $("#formRolModal").modal('show');
    })

    $("#btnRegistrarRol").click(function () {
        console.log("btnRegistrarRol");
        validacion.validate();
        if (validacion.isValid()) {
            console.info("pasó la validacion");
            $.ajax({
                type: "POST",
                url: "gestionarRol",
                data: {datos: kendo.modeloToJSON(rolModulo.rol)},
                success: function (data) {
                    rolModulo.gridRoles();
                    $("#formRolModal").modal('hide');
                },
                dataType: "html",
                async: false
            });
        }
    });

    $(document).on('click', '.editar', function () {
        var selRowId = $("#gridRoles").jqGrid('getGridParam', 'selrow');
        var data = $("#gridRoles").jqGrid('getRowData', selRowId);
        console.log(data);
        $.ajax({
            type: "POST",
            url: "consultarRol",
            data: {id_rol: data.id_rol},
            success: function (data) {
                kendo.autoset(rolModulo.rol, data);
                $("#formRolModal").modal('show');
            },
            dataType: "json",
            async: false
        });
    });

    rolModulo.gridRoles();

});