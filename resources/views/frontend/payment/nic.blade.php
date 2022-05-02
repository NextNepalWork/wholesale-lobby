<html>
<body>
    @php
        $esewa=\App\BusinessSetting::where('type','esewa_payment')->where('value',1)->first();
        
      $shipping = json_decode($ordercode->shipping_address,true);
      $delivery_address = \App\Location::where('id',$shipping['delivery_location'])->first();
      $delivery_address_1 = $delivery_address->name;
      
      $delivery_state = \App\State::where('id',$delivery_address->district)->first();
      $delivery_state_1 = $delivery_state->name; 
      
      $params = [
      'access_key' => 'cd7ac9c06b2b3bc8915cb8c08d2e2a93',
      'profile_id' => 'AC9E8149-F889-4C78-893B-EAF207B3C7AC',
      'transaction_uuid' => $ordercode->code,
      'signed_field_names' => 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,bill_address1,bill_city,bill_country,customer_email,customer_lastname',
      'unsigned_field_names' => '',
      'signed_date_time' => gmdate("Y-m-d\TH:i:s\Z"),
      'locale' => 'en',
      'auth_trans_ref_no' => '',
      'amount' => $ordercode->grand_total,
      'bill_to_forename' => (isset($shipping['name']))?$shipping['name']:'',
      'bill_to_surname' => (isset($shipping['name']))?$shipping['name']:'',
      'bill_to_email' => (isset($shipping['email']))?$shipping['email']:'',
      'bill_to_phone' => (isset($shipping['phone']))?$shipping['phone']:'',
      'bill_to_address_line1' => (isset($shipping['address']))?$shipping['address']:'',
      'bill_to_address_city' => (isset($shipping['city']))?$shipping['city']:'',
      'bill_to_address_state' => (isset($delivery_state_1))?$delivery_state_1:'',
      'bill_to_address_country' => 'NP',
      'bill_to_address_postal_code' => 'Kathmandu',
      'transaction_type' => 'sale',
      'reference_number' =>  date('Y-m-dh:i'),
      'currency' => 'NPR',
      'bill_address1' => (isset($delivery_address_1))?$delivery_address_1:'',
      'bill_city' => (isset($delivery_state_1))?$delivery_state_1:'',
      'bill_country' => 'Nepal',
      'customer_email' => (isset($shipping['email']))?$shipping['email']:'',
      'customer_lastname' => (isset($shipping['name']))?$shipping['name']:'',
      // 'amount' => $ordercode->grand_total,
      // 'submit' => ''
    ];
    @endphp

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php

    define ('HMAC_SHA256', 'sha256');
    define ('SECRET_KEY', '987d0a887554469d91f7250cc54aee72ca287c62f9b7449b99efab2a57a939e7a3bc470f59574ee784fee9455f6ddd3327d8ca2085b049da8f4899b7cb193c357517d02fc23942718239d8b54c01089be600aac7196343a6bc6ff2157ee6376ab92f9c351cdf46799bac098c6b59dc2e74908dd5e21b4f4faca456ce9bd86510');

    // dd($params);
    
    function sign ($params) {
      return signData(buildDataToSign($params), SECRET_KEY);
    }
    
    function signData($data, $secretKey) {
        return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
    }
    
    function buildDataToSign($params) {
      $signedFieldNames = explode(",",$params["signed_field_names"]);
      foreach ($signedFieldNames as $field) {
          $dataToSign[] = $field . "=" . $params[$field];
      }
      return commaSeparate($dataToSign);
    }
    
    function commaSeparate ($dataToSign) {
        return implode(",",$dataToSign);
    }

    ?>
    <form id="payment_confirmation" action="https://testsecureacceptance.cybersource.com/pay" method="post"><br/>
      
<input type="submit" id="submit" value="Redirecting to NIC Pay..."/>
      <?php
    //   $name.' = '.$value .
      foreach($params as $name => $value) {
          echo " <input type=\"hidden\" id=\"" . $name . "\" name=\"" . $name . "\" value=\"" . $value . "\"/>\n<br>";
      }
      echo "<input type=\"hidden\" id=\"signature\" name=\"signature\" value=\"" . sign($params) . "\"/>\n";
  ?>

      
  </form>

  {{-- <script type="text/javascript" src="payment_form.js"></script> --}}
    <script>
      $(function () {
          payment_form = $('form').attr('id');
          addLinkToSetDefaults();
      });


      function setDefaultsForAll() {
          if (payment_form === "payment_confirmation"){
            setDefaultsForUnsignedDetailsSection();
          }
          else {
            setDefaultsForPaymentDetailsSection();
        } 
      }

      function addLinkToSetDefaults() {
          $(".section").prev().each(function (i) {
              legendText = $(this).text();
              $(this).text("");

              var setDefaultMethod = "setDefaultsFor" + capitalize($(this).next().attr("id")) + "()";

              newlink = $(document.createElement("a"));
              newlink.attr({
                  id:'link-' + i, name:'link' + i, href:'#'
              });
              newlink.append(document.createTextNode(legendText));
              newlink.bind('click', function () {
                  eval(setDefaultMethod);
              });

              $(this).append(newlink);
          });

          // newbutton = $(document.createElement("input"));
          // newbutton.attr({
          //     id:'defaultAll', value:'Default All', type:'button', onClick:'setDefaultsForAll()'
          // });
          // newbutton.bind('click', function() {
          //     setDefaultsForAll;
          // });
          // $("#"+payment_form).append(newbutton);
      }

      function capitalize(string) {
          return string.charAt(0).toUpperCase() + string.slice(1);
      }

      function setDefaultsForPaymentDetailsSection() {
          $("input[name='transaction_type']").val("authorization");
          $("input[name='reference_number']").val(new Date().getTime());
          $("input[name='amount']").val("100.00");
          $("input[name='currency']").val("USD");
      }

      function setDefaultsForUnsignedDetailsSection(){
          $("input[name='card_type']").val("001");
          $("input[name='card_number']").val("4242424242424242");
          $("input[name='card_expiry_date']").val("11-2020");
      }



      $('#submit').trigger('click');    
    </script>
    
  </body>
  
  </html>