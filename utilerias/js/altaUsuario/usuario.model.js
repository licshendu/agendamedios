var usuarioModelo = {
    id_usuario: "",
    usuario: "",
    contrasenia: "",
    nombre: "",
    primer_apellido: "",
    segundo_apellido: "",
    roles:"",
    enab: {
        id_usuario: true,
        usuario: true,
        contrasenia: true,
        nombre: true,
        primer_apellido: true,
        segundo_apellido: true
    },
    inv: {
        id_usuario: false,
        usuario: false,
        contrasenia: false,
        nombre: false,
        primer_apellido: false,
        segundo_apellido: false
    },
    src: {
        roles:new kendo.data.DataSource({
            type: "json",
            transport: {
                read: {
                    url: "listarRoles",
                    type: "GET",
                    async: false,
                    data: {}
                }
            }
        })
    },
    spin: {
    },
    chg: {
        usuario: function () {},
        contrasenia: function () {},
        nombre: function () {},
        primer_apellido: function () {},
        segundo_apellido: function () {}
    }
}