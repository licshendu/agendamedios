var rolModelo = {
    id_rol: "",
    rol: "",
    opciones: "",
    enab: {
        id_rol: true,
        rol: true,
        opciones: true
    },
    inv: {
        id_rol: false,
        rol: false,
        opciones: false
    },
    src: {
        opciones: new kendo.data.DataSource({
            type: "json",
            transport: {
                read: {
                    url: "listarOpciones",
                    type: "GET",
                    async: false,
                    data: {}
                }
            }
        })
    }
}