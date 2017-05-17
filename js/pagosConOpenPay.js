// JavaScript source code
var openPayObj = function (idMercader, idPublico, domIdFormDePago, domIdBotonDePago, domIdTokenId) {
    this.idMercader = idMercader; //id de mercador proporcionado por openpay al crear tu cuenta
    this.idPublico = idPublico; //id de mercador proporcionado por openpay al crear tu cuenta. Nota: Es diferente al id proporcionado en pagosConOpenPay.php
    this.idDomFormDePago = domIdFormDePago; //identificador de html tag del form de pago
    this.idDomBotonDePago = domIdBotonDePago; //identificador de html tag del boton de pago
    this.domFormDePago = null; 
    this.domBotonDePago = null;
    this.domTokenId = domIdTokenId; //identificador de html tag del token id. Nota: Suele ser un <input hidden />
    var me = this;

    $(document).ready(function () {
        OpenPay.setId(me.idMercader); 
        OpenPay.setApiKey(me.idPublico);

        OpenPay.setSandboxMode(true); //Hay que ponerlo a falso en producción

        me.domFormDePago = $("#" + me.idDomFormDePago);
        me.domBotonDePago = $("#" + me.idDomBotonDePago);
        me.domTokenId = $("#" + me.domTokenId);

        var deviceSessionId = OpenPay.deviceData.setup(me.idDomFormDePago, "deviceIdHiddenFieldName");

        me.domBotonDePago.on('click', function (event) {
            event.preventDefault();
            me.domBotonDePago.prop("disabled", true);
            OpenPay.token.extractFormAndCreate(me.idDomFormDePago, sucess_callbak, error_callbak);
        });

        //Funciones callback de la función  OpenPay.token.extractFormAndCreate
        var sucess_callbak = function (response) {
            var token_id = response.data.id;
            me.domTokenId.val(token_id);
            me.domFormDePago.submit();
        };

        var error_callbak = function (response) {
            var desc = response.data.description != undefined ? response.data.description : response.message;
            alert("ERROR [" + response.status + "] " + desc);
            me.domBotonDePago.prop("disabled", false);
        };
        //Funciones callback de la función  OpenPay.token.extractFormAndCreate
    });

    /*
    Funciones para validar la información de la tarjeta de crédito antes de enviarla al servidor
        Validación de número de tarjeta
            OpenPay.card.validateCardNumber('5555555555554444');
        Validación de Código de Seguridad
            OpenPay.card.validateCVC('1234'); // válido
        Validación de fecha de expiración
            OpenPay.card.validateExpiry('01', '2013'); // inválido
        Validación del tipo de tarjeta
            OpenPay.card.cardType('5555555555554444'); // Mastercard
            ​OpenPay.card.cardType('4111111111111111'); //​ Visa
            OpenPay.card.cardType('4917300800000000'); // Visa Electron
            OpenPay.card.cardType('378282246310005'); // American Express

    
    Compatibilidad y requerimientos
        Para utilizar Openpay.js es necesario contar con uno de los siguientes navegadores:
            Chrome 29.0+
            Firefox 23.0+
            Safari 5.1+
            Opera 17.0+
            iOS Safari 4.0+
            Android Browser 2.1+
            Blackberry Browser 7.0+
            IE Mobile 10.0
    */
}
