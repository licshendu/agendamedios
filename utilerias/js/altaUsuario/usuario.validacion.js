var validacion;
$(function () {
    validacion = $('#alta-usuario').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            usuario: {
                validators: {
                    max: {message: 'longitud maxima 50'},
                    notEmpty: {message: 'campo requerido'}
                }
            },
            contrasenia: {
                validators: {
                    max: {message: 'longitud maxima 80'},
                    notEmpty: {message: 'campo requerido'}
                }
            },
            nombre: {
                validators: {
                    max: {message: 'longitud maxima 80'},
                    notEmpty: {message: 'campo requerido'}
                }
            },
            primer_apellido: {
                validators: {
                    max: {message: 'longitud maxima 80'},
                    notEmpty: {message: 'campo requerido'}
                }
            },
            segundo_apellido: {
                validators: {
                    max: {message: 'longitud maxima 80'}
                }
            },
            roles: {
                validators: {
                    notEmpty: {message: 'campo requerido'}
                }
            }
        }
    }).data().formValidation;

});