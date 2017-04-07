var calendario = (function (window, undefined) {
    var pb = {}, pv = {};
    pb.eventos = [];
    pv.colores = ['FF5733', 'FFAF33', 'C70039', 'DAF7A6', 'ACFF33', '40A440',
        '377B37', '900C3F', '581845', '4BB88D', '4BAEB8', '4B82B8',
        '12149A', '4A129A', 'C639E2', 'E239DA', 'E23986'];
    pb.eventoSeleccionado = kendo.observable({
        title: "",
        fecha_inicio: "",
        fecha_fin: "",
        descripcion: "",
        enabled: false
    })
    pb.cargarEventos = function () {
        $.ajax({
            type: "POST"
            , dataType: "json"
            , encoding: "utf-8"
            , contentType: "application/x-www-form-urlencoded"
            , url: "listarEventos"
            , async: false
            , data: {}
        }).done(function (respuesta) {
            console.log("--done--");
            respuesta.forEach(function (item, index) {
                console.log(item, index);
                pb.eventos.push({id: item.id_evento, title: item.evento, descripcion: item.descripcion, fecha_inicio: item.fecha_inicio,
                    fecha_fin: item.fecha_fin,
                    start: item.fecha_inicio, end: item.fecha_fin, color: '#' + pv.colores[Math.floor(Math.random() * pv.colores.length)]});
            });

        });
    }

    pb.generarCalendario = function () {

    };
    return pb;
}(window, undefined));

$(document).ready(function () {
    calendario.cargarEventos();
    $('#calendario').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        resources: {
            url: '/listarEventos',
            type: 'POST'
        },
        defaultDate: moment().format(),
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        events: calendario.eventos,
        eventClick: function (calEvent, jsEvent, view) {
            console.log(calEvent);
            console.log(jsEvent);
            console.log(view);
//            alert('Event: ' + calEvent.title);
//            alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
//            alert('View: ' + view.name);
            kendo.autoset(calendario.eventoSeleccionado, calEvent);
            $(this).css('border-color', 'red');

        }
    });

    kendo.bind($("#ficha-Evento"), calendario.eventoSeleccionado);

});
