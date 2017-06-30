// JavaScript source code
$(document).ready(function () {
    var confirmEmail = $('#confirmEmailPagarConTienda');
    var email = $('#emailPagarConTienda');
    var pagarTiendaBtn = $('#pagarTienda');
    var monto = $('#montoPagarConTienda');
    var nombre = $('#nombreClientePagarConTienda');
    var apellidos = $("#apellidosClientePagarConTienda");

    pagarTiendaBtn.on('click', function (event) {
        event.preventDefault();
        pagarTiendaBtn.prop("disabled", true);

        if (confirmEmail.val() === '' || email.val() === '' || monto.val() === '' || nombre.val() === '' || apellidos.val() === '') {
            alert('Lleno todos los campos para continuar.');
            pagarTiendaBtn.prop("disabled", false);
            return;
        }
        if (confirmEmail.val() !== email.val()) {
            alert('Los campos de correo y correo de confirmación no coinciden.');
            confirmEmail.val('');
            pagarTiendaBtn.prop("disabled", false);
            return;
        }
        $('#pagarConTiendaForm').submit();
    });

    confirmEmail.on('paste', function (event) {
        var element = this;
        setTimeout(function () {
            var text = $(element).val();
            // do something with text
            confirmEmail.val('');
        }, 100);
    });
});
