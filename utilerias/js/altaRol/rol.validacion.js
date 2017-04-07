var validacion;
$(function () {
    validacion = $('#alta-rol').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            rol: {
                validators: {
                    stringLength: {
                        max: 80,
                        message: 'debe ser menor a 80 caracteres'
                    },
                    notEmpty: {message: 'campo requerido'}
                }
            },
            opciones: {
                validators: {
                    notEmpty: {message: 'campo requerido'}
                }
            }
        }
    }).data().formValidation;

});