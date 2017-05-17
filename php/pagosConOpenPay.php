<?php
require_once "../openPayPHP/openpay-php/Openpay.php";

class openPayObj {
    private $op;
    private $idMercader;
    private $idPrivado;

    public function __construct($idMercader,$idPrivado){
      $this->idMercader =  $idMercader;
      $this->idPrivado = $idPrivado;
          $this->op = Openpay::getInstance($this->idMercader, //Id
          $this->idPrivado); //Private Key    
  }

    private function getError($errorCode){
      $errorMsg = "";
      switch($errorCode){
          //Webhooks
          case 6001:
              $errorMsg = "El webhook ya ha sido procesado.";
              break;
          case 6002:
              $errorMsg = "No se ha podido conectar con el servicio de webhook.";
              break;
          case 6003:
              $errorMsg = "El servicio respondio con errores.";
              break;

          //Ordenes
          case 5001:
              $errorMsg = "La orden con este identificador externo (external_order_id) ya existe.";
              break;

          //Cuentas
          case 4001:
              $errorMsg = "La cuenta de Openpay no tiene fondos suficientes.";
              break;

          case 4002:
              $errorMsg = "La operación no puede ser completada hasta que sean pagadas las comisiones pendientes.";
              break;

          //Tarjetas
          case 3001:
              $errorMsg = "La tarjeta fue declinada.";
              break;
          case 3002:
              $errorMsg = "La tarjeta ha expirado.";
              break;
          case 3003:
              $errorMsg = "La tarjeta no tiene fondos suficientes.";
              break;
          case 3004:
              $errorMsg = "La tarjeta ha sido identificada como una tarjeta robada.";
              break;
          case 3005:
              $errorMsg = "La tarjeta ha sido rechazada por el sistema antifraudes.";
              break;
          case 3006:
              $errorMsg = "La operación no esta permitida para este cliente o esta transacción.";
              break;
          case 3007:
              $errorMsg = "Deprecado. La tarjeta fue declinada.";
              break;
          case 3008:
              $errorMsg = "La tarjeta no es soportada en transacciones en línea.";
              break;
          case 3009:
              $errorMsg = "La tarjeta fue reportada como perdida.";
              break;
          case 3010:
              $errorMsg = "El banco ha restringido la tarjeta.";
              break;
          case 3011:
              $errorMsg = "El banco ha solicitado que la tarjeta sea retenida. Contacte al banco.";
              break;
          case 3012:
              $errorMsg = "Se requiere solicitar al banco autorización para realizar este pago.";
              break;

          //Almacenamiento
          case 2001:
              $errorMsg = "La cuenta de banco con esta CLABE ya se encuentra registrada en el cliente.";
              break;
          case 2002:
              $errorMsg = "La tarjeta con este número ya se encuentra registrada en el cliente.";
              break;
          case 2003:
              $errorMsg = "El cliente con este identificador externo (External ID) ya existe.";
              break;
          case 2004:
              $errorMsg = "El dígito verificador del número de tarjeta es inválido de acuerdo al algoritmo Luhn.";
              break;
          case 2005:
              $errorMsg = "La fecha de expiración de la tarjeta es anterior a la fecha actual.";
              break;
          case 2006:
              $errorMsg = "El código de seguridad de la tarjeta (CVV2) no fue proporcionado.";
              break;
          case 2007:
              $errorMsg = "El número de tarjeta es de prueba, solamente puede usarse en Sandbox.";
              break;
          case 2008:
              $errorMsg = "La tarjeta no es valida para puntos Santander.";
              break;

          //Generales
          case 1000:
              $errorMsg = "Ocurrió un error interno en el servidor de Openpay";
              break;
          case 1001:
              $errorMsg = "El formato de la petición no es JSON, los campos no tienen el formato correcto, o la petición no tiene campos que son requeridos.";
              break;
          case 1002:
              $errorMsg = "La llamada no esta autenticada o la autenticación es incorrecta.";
              break;
          case 1003:
              $errorMsg = "La operación no se pudo completar por que el valor de uno o más de los parametros no es correcto.";
              break;
          case 1004:
              $errorMsg = "Un servicio necesario para el procesamiento de la transacción no se encuentra disponible.";
              break;
          case 1005:
              $errorMsg = "Uno de los recursos requeridos no existe.";
              break;
          case 1006:
              $errorMsg = "Ya existe una transacción con el mismo ID de orden.";
              break;
          case 1007:
              $errorMsg = "La transferencia de fondos entre una cuenta de banco o tarjeta y la cuenta de Openpay no fue aceptada.";
              break;
          case 1008:
              $errorMsg = "Una de las cuentas requeridas en la petición se encuentra desactivada.";
              break;
          case 1009:
              $errorMsg = "El cuerpo de la petición es demasiado grande.";
              break;
          case 1010:
              $errorMsg = "Se esta utilizando la llave pública para hacer una llamada que requiere la llave privada, o bien, se esta usando la llave privada desde JavaScript.";
              break;
          case 1011:
              $errorMsg = "Se solicita un recurso que esta marcado como eliminado.";
              break;
          case 1012:
              $errorMsg = "El monto transacción esta fuera de los limites permitidos.";
              break;
          case 1013:
              $errorMsg = "La operación no esta permitida para el recurso.";
              break;
          case 1014:
              $errorMsg = "La cuenta esta inactiva.";
              break;
          case 1015:
              $errorMsg = "No se ha obtenido respuesta de la solicitud realizada al servicio.";
              break;
          case 1016:
              $errorMsg = "El mail del comercio ya ha sido procesada.";
              break;
          case 1017:
              $errorMsg = "El gateway no se encuentra disponible en ese momento.";
              break;
          case 1018:
              $errorMsg = "El número de intentos de cargo es mayor al permitido.";
              break;
          default:
              $errorMsg = "Error no registrado, asegurese que el codigo de error sea válido e intente de nuevo";
              break;
      }
      return $errorMsg;
  }

    public function pagarConTarjeta($tokenId,$cantidad,$nombre,$idDispositivo,$email,$telefono){
      /*
      DOCUMENTACIÓN DE LA FUNCIÓN
      Input:
      $tokenId = string
      $cantidad = float
      $nombre = string
      $idDispositivo = string
      $email = string
      $telefono = string

      Output: array
      Array (
      [status] => 0,
      [error] => '',
      [error_code] => -1
      );

      Descripción
      Si algo falla durante el proceso 'status' = -1
      Mas información en:
      'error' = mensaje de error
      'errorCode' = codigo de error


      Si todo está correcto 'status' = 0

      DOCUMENTACIÓN DE LA FUNCIÓN
       */

      //Hay que cambiar estas llaves por las propias. Esto se logra creando una cuenta en la página web de openPay

      //Hay que cambiar estas llaves por las propias. Esto se logra creando una cuenta en la página web de openPay

      $customer = array(
          'name' => $nombre,
          'phone_number' => $telefono,
          'email' => $email
          );

      $chargeData = array(
          'method' => 'card',
          'source_id' => $tokenId,
          'amount' => (float)$cantidad,
          'device_session_id' => $idDispositivo,
          'customer' => $customer
          );


      $charge = null;
      $errorMsg = null;
      $errorCode = null;
      try{
          $charge = $this->op->charges->create($chargeData);
      }
      catch(Exception $e){
          $errorMsg = $e->getMessage();
          $errorCode =  $e->getCode();
      }

      $status = null;
      if($errorMsg !== null || $errorCode !== null){
          $errorMsg = $this->getError($errorCode);
          $status = array("status"=>-1,"error" =>$errorMsg,"errorCode" => $errorCode);
      }
      else
          $status = array("status"=>0,"error"=>"ok","errorCode" => -1);

      return $status;
      //$status Tendrá siempre dos elementos "status" y "error". "status":= -1 cuando hay un error "status":= 0 cuando todo esta correcto. El mensaje de error lo encuentras en el segundo elemento "error"
  }

    public function pagarEnTienda($monto,$descripcion,$nombre,$apellidos,$email){
    /*
    DOCUMENTACIÓN DE LA FUNCIÓN
    Input:
    $monto = float
    $descripcion = string
    $nombre = string
    $apellidos = string
    $email = string

    Output: array
    Array (
    [status] => 0,
    [error] => '',
    [error_code] => -1
    [receipt] => 'https://sandbox-dashboard.openpay.mx/paynet-pdf/mxnx5ol3qwf9q9y82pp3/OPEN12300N75TAYQ6'
    );

    Descripción
    Si algo falla durante el proceso 'status' = -1
    Mas información en:
    'error' = mensaje de error
    'errorCode' = codigo de error


    Si todo está correcto 'status' = 0
    El recibo se encuentra el la liga contenida en el indice 'receipt'
    DOCUMENTACIÓN DE LA FUNCIÓN
     */

    $customer = array(
        'name' => $nombre,
        'last_name' => $apellidos,
        'email' => $email
    );

    $chargeRequest = array(
      'method' => 'store', // id de cargo a tiendas de conveniencia
      'amount' => (float)$monto, // cargo o cantidad a pagar
      'description' => $descripcion, // descripcion
      'customer' => $customer
      );

    // recibe id del cliente previamente creado....(almacenado preferentemente en db)

    $errorMsg = null;
    $errorCode = null;
    try{
        $charge = $this->op->charges->create($chargeRequest);
    }
    catch(Exception $e){
        $errorMsg = $e->getMessage();
        $errorCode = $e->getCode();
    }


    if($errorCode != null){
        $errorMsg = $this->getError($errorCode);
        $res = array("status"=>-1,"error" => $errorMsg,"receipt" => "","errorCode" => $errorCode,"receipt" => "");
        return $res;
    }

    //$charge
    // {
    //   "id" : "t6utz9dywve6zipnppys",
    //   "description" : "Cargo con tienda",
    //   "error_message" : null,
    //   "authorization" : null,
    //   "amount" : 100,
    //   "operation_type" : "in",
    //   "payment_method" : {
    //     "type" : "store",
    //     "reference" : "123456ABCDEFGHIJLKMNOPQRSTVW010000",
    //     "paybin_reference":"0101990000001065",
    //     "barcode_url" : "https://sandbox-api.openpay.mx/barcode/123456ABCDEFGHIJLKMNOPQRSTVW010000?width=1&height=45",
    //     "barcode_paybin_url":"https://sandbox-api.openpay.mx/barcode/0101990000001065?width=1&height=45&text=false"
    //   },
    //   "order_id" : "oid-00052",
    //   "transaction_type" : "charge",
    //   "creation_date" : "2013-12-05T17:50:09-06:00",
    //   "currency" : "MXN",
    //   "status" : "in_progress",
    //   "method" : "store"
    // }

    $dashBoardPath = "https://sandbox-dashboard.openpay.mx"; //SandBox
    //$dashBoardPath = "https://dashboard.openpay.mx"; //Production


    $charge->payment_method->barcode_url; // BARCODE URL TIENE EL CODIGO DE BARRAS QUE TIENE QUE PAGAR EL CLIENTE EN LAS TIENDAS

    if($charge->error_message !== null){
        $res = array("status"=>-1,"error" => $charge->error_message,"errorCode" => 1000,"receipt" => "");
        return $res;
    }
    else{
        $receipt =  $dashBoardPath."/paynet-pdf/".$this->idMercader."/".$charge->payment_method->reference;
        $res = array("status"=>0,"error" => "", "errorCode" => -1 ,"receipt" => $receipt);
        return $res;
    }
}


  public function __destruct(){

  }
}


?>