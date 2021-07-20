<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  //require 'vendor/autoload.php';
  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;

class Extension_model extends CI_Model {

    function get_extensions($path = 'home', $part = 'left')
    {
		$query = $this->db->query("SELECT e.name FROM extension e LEFT JOIN part p ON (e.part_id = p.part_id) WHERE e.status = '1' AND p.name = ". $this->db->escape($part) ." AND (e.path = ". $this->db->escape($path) ." OR e.path = 'all')");		
		return $query->result_array();
    }
    function email_queue($to, $subject, $body, $from)
    {
    	//send otp email
	  $this->load->library('email');
      $this->email->set_mailtype("html");
      $this->email->from($from);
      $this->email->to($to);
      //$this->email->cc('another@another-example.com');
      //$this->email->bcc('them@their-example.com');

      $this->email->subject($subject);
      $msg = '';
      $msg .='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<div style="font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
    <table style="width: 100%;">
      <tr>
        <td></td>
        <td bgcolor="#FFFFFF ">
          <div style="padding: 15px; max-width: 600px;margin: 0 auto;display: block; border-radius: 0px;padding: 0px; border: 1px solid lightseagreen;">
            <table style="width: 100%;background: #fff ;">
              <tr>
                <td></td> 
                <td>
                  <div>
                    <table width="100%">
                      <tr>
                        <td rowspan="2" style="text-align:center;padding:10px;">
              <img style="float:left; " width="200"  src="'.base_url().'assets/images/logo.png" /> 
              
              <span style="color:white;float:right;font-size: 13px;font-style: italic;margin-top: 20px; padding:10px; font-size: 14px; font-weight:normal;">
              <a href="'.base_url().'" style="color: #000;text-decoration: none;">Goto Website</a><span></span></span></td>
                      </tr>
                    </table>
                  </div>
                </td>
                <td></td>
              </tr>
            </table>
            <table style="padding: 10px;font-size:17px; width:100%;">
              <tr><td style="padding: 0 20px;font-size:17px; width:100%;" colspan="10">'. $body.'</td></tr>
        <tr> 
        <td>
         <div align="center" style="font-size:12px; margin-top:20px; padding:5px; width:100%; background:#eee;">
                    © 2020 <a href="'.base_url().'" target="_blank" style="color:#333; text-decoration: none;">jmor.com</a>
                  </div>
                </td>
        </tr>
              <tr><td style="text-align: center;"><small style="text-align: center;"><a class="text-light" href="http://www.jmor.com" style="text-align: center;color: #000;text-decoration: none;">Proudly Designed, Hosted &amp; Maintained by Neighborhood Publications
      <br>
      We Give your Business a Voice™ </a></small></td></tr>
            </table>
          </div>
</body>
</html>';
      $this->email->message($msg);

      if($this->email->send())
      {
          return true;
      }
      else
      {
          return false;
      }
		//end otp email
    }
	
	
	
	
	
	
	
	
	 function email_invoice_client($to_admin, $subject, $message, $form_admin)
    {
    	//send otp email
	  $this->load->library('email');
      $this->email->set_mailtype("html");
      $this->email->from($form_admin);
      $this->email->to($to_admin);
      //$this->email->cc('another@another-example.com');
      //$this->email->bcc('them@their-example.com');

      $this->email->subject($subject);
 
      $this->email->message($message);

      if($this->email->send())
      {
          return true;
      }
      else
      {
          return false;
      }
		//end otp email
    }
   
	
	
	
	function email_invoice_admin($to, $subject, $message, $from)
    {
    	//send otp email
	  $this->load->library('email');
      $this->email->set_mailtype("html");
      $this->email->from($from);
      $this->email->to($to);
      //$this->email->cc('another@another-example.com');
      //$this->email->bcc('them@their-example.com');

      $this->email->subject($subject);
 
      $this->email->message($message);

      if($this->email->send())
      {
          return true;
      }
      else
      {
          return false;
      }
		//end otp email
    }
   
	
	
	
	
	
	
	
    public function get_ip()
    {
        $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
         $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';
      return $ipaddress;
    }
    public function get_member_name($id)
    {
        $det = $this->db->get_where('user', array('user_id'=> $id))->result_array();
        return $det[0]['firstname'].' '.$det[0]['lastname'];
    }
    //authorize.net payment
    
 

function chargeCreditCard($post, $cart_id)
{
    //merchant credentials
    $MERCHANT_LOGIN_ID = "9mbW55hHyrM5";
    $MERCHANT_TRANSACTION_KEY = "7kyw78S849ES8vSj";
    $customer_info = $this->db->get_where('user', array('user_id'=> $_SESSION['user_id']))->result_array();
    $c_email = $customer_info[0]['email'];
    $c_address = $customer_info[0]['address'];
    $c_firstName = $customer_info[0]['firstname'];
    $c_lastName = $customer_info[0]['lastname'];
    $c_city = $customer_info[0]['city'];
    $c_state = $customer_info[0]['state'];
    $c_zip = $customer_info[0]['zip'];
    //cart data

      //get cart service
      $this->db->where('cart_id', $_SESSION['cart_id']);
      $cart_service = $this->db->get('cart_add_service')->result_array();
      //get service cost price
      $this->db->where('id', $cart_service[0]['service_id']);
      $service_details = $this->db->get('services')->result_array();
      $this->db->where('cart_id', $_SESSION['cart_id']);
                                        $cart_options = $this->db->get('cart_options_service')->result_array();
       $options_cost = 0;
                                        for($o=0; $o<count($cart_options); $o++)
                                        {
                                            $options_cost = $options_cost + $cart_options[$o]['option_price'];
                                             
                                        }

      $amount = $options_cost + $service_details[0]['price'];
      $percentage = $service_details[0]['upfront'];
      $totalPrice = $amount;
      $amount = ($percentage / 100) * $totalPrice; 
      
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName($MERCHANT_LOGIN_ID);//MERCHANT_LOGIN_ID
    $merchantAuthentication->setTransactionKey($MERCHANT_TRANSACTION_KEY);//MERCHANT_TRANSACTION_KEY
    
    // Set the transaction's refId
    $refId = 'ref' . time();

    // Create the payment data for a credit card
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber(str_replace(' ', '',$post['cardNumber']));
    $creditCard->setExpirationDate($post['cardExp']);
    $creditCard->setCardCode($post['cardCvc']);

    // Add the payment data to a paymentType object
    $paymentOne = new AnetAPI\PaymentType();
    $paymentOne->setCreditCard($creditCard);

    // Create order information
    $order = new AnetAPI\OrderType();
    $order->setInvoiceNumber($_SESSION['cart_id']);
    $order->setDescription($service_details[0]['name']);

    // Set the customer's Bill To address
    $customerAddress = new AnetAPI\CustomerAddressType();
    $customerAddress->setFirstName($c_firstName);
    $customerAddress->setLastName($c_lastName);
    $customerAddress->setCompany(" ");
    $customerAddress->setAddress($c_address);
    $customerAddress->setCity($c_city);
    $customerAddress->setState($c_state);
    $customerAddress->setZip($c_zip);
    $customerAddress->setCountry("USA");

    // Set the customer's identifying information
    $customerData = new AnetAPI\CustomerDataType();
    $customerData->setType("individual");
    $customerData->setId($_SESSION['cart_id']);
    $customerData->setEmail($c_email);

    // Add values for transaction settings
    $duplicateWindowSetting = new AnetAPI\SettingType();
    $duplicateWindowSetting->setSettingName("duplicateWindow");
    $duplicateWindowSetting->setSettingValue("60");

    // Add some merchant defined fields. These fields won't be stored with the transaction,
    // but will be echoed back in the response.
    $merchantDefinedField1 = new AnetAPI\UserFieldType();
    $merchantDefinedField1->setName("customerID");
    $merchantDefinedField1->setValue($_SESSION['user_id']);

    //$merchantDefinedField2 = new AnetAPI\UserFieldType();
    //$merchantDefinedField2->setName("favoriteColor");
    //$merchantDefinedField2->setValue("blue");

    // Create a TransactionRequestType object and add the previous objects to it
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType("authCaptureTransaction");
    $transactionRequestType->setAmount($amount);
    $transactionRequestType->setOrder($order);
    $transactionRequestType->setPayment($paymentOne);
    //$transactionRequestType->setBillTo($c_address);
    //$transactionRequestType->setCustomer($_SESSION['user_id']);
    $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
    $transactionRequestType->addToUserFields($merchantDefinedField1);
    //$transactionRequestType->addToUserFields($merchantDefinedField2);

    // Assemble the complete transaction request
    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);

    // Create the controller and get the response
    $controller = new AnetController\CreateTransactionController($request);
    //$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
    // For PRODUCTION use
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

    if ($response != null) {
        // Check to see if the API request was successfully received and acted upon
        if ($response->getMessages()->getResultCode() == "Ok") {
            // Since the API request was successful, look for a transaction response
            // and parse it to display the results of authorizing the card
            $tresponse = $response->getTransactionResponse();
             $status_code = $tresponse->getResponseCode();
            if($status_code == 1)
            {
            //print_r($tresponse->getResponseCode());
                $this->db->insert('cart_payment_details', array('cart_id'=> $_SESSION['cart_id'], 'trx_id' => $tresponse->getTransId(), 'status'=> $tresponse->getResponseCode(), 'description'=> $tresponse->getMessages()[0]->getDescription(null), 'auth_code' => $tresponse->getAuthCode(), 'amount' => $amount ));
                $to = $c_email;
                $subject = 'You have got new status update.';
                $body = '<p>You order has been placed successfully, your order #'.$this->config->item('invoice_prefix').$id.' please login for more details and status of the order.</p>';
                $from = '';
                $CI =& get_instance();
                //$this->load->model('extension_model');      
                $CI->Extension_model->email_queue($to, $subject, $body, $from);

                unset($_SESSION['cart_id']);
                unset($_SESSION['service_id']);

                redirect(base_url().'success');
            }
            else
            {
                redirect(base_url().'payment?error');
            }
            
            
            
            // Or, print errors if the API request wasn't successful
        } else {
            redirect(base_url().'error');
            //echo "Transaction Failed \n";
            //$tresponse = $response->getTransactionResponse();
        
            if ($tresponse != null && $tresponse->getErrors() != null) {
              //  echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                //echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
            } else {
                //echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
                //echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
            }
        }
    } else {
        echo  "No response returned \n";
    }

    return $response;
}

//partial payments
function chargePartialPayment($post, $id)
{
    //merchant credentials
    $MERCHANT_LOGIN_ID = "9mbW55hHyrM5";
    $MERCHANT_TRANSACTION_KEY = "7kyw78S849ES8vSj";
    $customer_info = $this->db->get_where('user', array('user_id'=> $_SESSION['user_id']))->result_array();
    $c_email = $customer_info[0]['email'];
    $c_address = $customer_info[0]['address'];
    $c_firstName = $customer_info[0]['firstname'];
    $c_lastName = $customer_info[0]['lastname'];
    $c_city = $customer_info[0]['city'];
    $c_state = $customer_info[0]['state'];
    $c_zip = $customer_info[0]['zip'];
    //cart data

      //get cart service
      $this->db->where('id', $id);
      $payment_amt = $this->db->get('cart_payment_details')->result_array();
      
      $amount = $payment_amt[0]['amount'];
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName($MERCHANT_LOGIN_ID);//MERCHANT_LOGIN_ID
    $merchantAuthentication->setTransactionKey($MERCHANT_TRANSACTION_KEY);//MERCHANT_TRANSACTION_KEY
    
    // Set the transaction's refId
    $refId = 'ref' . time();

    // Create the payment data for a credit card
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber(str_replace(' ', '',$post['cardNumber']));
    $creditCard->setExpirationDate($post['cardExp']);
    $creditCard->setCardCode($post['cardCvc']);

    // Add the payment data to a paymentType object
    $paymentOne = new AnetAPI\PaymentType();
    $paymentOne->setCreditCard($creditCard);

    // Create order information
    $order = new AnetAPI\OrderType();
    $order->setInvoiceNumber($payment_amt[0]['cart_id']);
    $order->setDescription($payment_amt[0]['notes']);

    // Set the customer's Bill To address
    $customerAddress = new AnetAPI\CustomerAddressType();
    $customerAddress->setFirstName($c_firstName);
    $customerAddress->setLastName($c_lastName);
    $customerAddress->setCompany(" ");
    $customerAddress->setAddress($c_address);
    $customerAddress->setCity($c_city);
    $customerAddress->setState($c_state);
    $customerAddress->setZip($c_zip);
    $customerAddress->setCountry("USA");

    // Set the customer's identifying information
    $customerData = new AnetAPI\CustomerDataType();
    $customerData->setType("individual");
    $customerData->setId($payment_amt[0]['cart_id']);
    $customerData->setEmail($c_email);

    // Add values for transaction settings
    $duplicateWindowSetting = new AnetAPI\SettingType();
    $duplicateWindowSetting->setSettingName("duplicateWindow");
    $duplicateWindowSetting->setSettingValue("60");

    // Add some merchant defined fields. These fields won't be stored with the transaction,
    // but will be echoed back in the response.
    $merchantDefinedField1 = new AnetAPI\UserFieldType();
    $merchantDefinedField1->setName("customerID");
    $merchantDefinedField1->setValue($_SESSION['user_id']);

    //$merchantDefinedField2 = new AnetAPI\UserFieldType();
    //$merchantDefinedField2->setName("favoriteColor");
    //$merchantDefinedField2->setValue("blue");

    // Create a TransactionRequestType object and add the previous objects to it
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType("authCaptureTransaction");
    $transactionRequestType->setAmount($amount);
    $transactionRequestType->setOrder($order);
    $transactionRequestType->setPayment($paymentOne);
    //$transactionRequestType->setBillTo($c_address);
    //$transactionRequestType->setCustomer($_SESSION['user_id']);
    $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
    $transactionRequestType->addToUserFields($merchantDefinedField1);
    //$transactionRequestType->addToUserFields($merchantDefinedField2);

    // Assemble the complete transaction request
    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);

    // Create the controller and get the response
    $controller = new AnetController\CreateTransactionController($request);
    //$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
    // For PRODUCTION use
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

    if ($response != null) {
        // Check to see if the API request was successfully received and acted upon
        if ($response->getMessages()->getResultCode() == "Ok") {
            // Since the API request was successful, look for a transaction response
            // and parse it to display the results of authorizing the card
            $tresponse = $response->getTransactionResponse();
             $status_code = $tresponse->getResponseCode();
            if($status_code == 1)
            {
            //print_r($tresponse->getResponseCode());
                $this->db->where('id', $payment_amt[0]['id'] );
                $this->db->update('cart_payment_details', array('trx_id' => $tresponse->getTransId(), 'status'=> $tresponse->getResponseCode(), 'description'=> $tresponse->getMessages()[0]->getDescription(null), 'auth_code' => $tresponse->getAuthCode()));
                $to = $c_email;
                $subject = 'You have made payment successfully.';
                $body = '<p>You payment made successfully on your order payment request, Order #'.$this->config->item('invoice_prefix').$id.' please login for more details and status of the order.</p>';
                $from = '';
                $CI =& get_instance();
                //$this->load->model('extension_model');      
                $CI->Extension_model->email_queue($to, $subject, $body, $from);

                redirect(base_url().'/single-invoice/'.$payment_amt[0]['cart_id'].'?success');
            }
            else
            {
                redirect(base_url().'/single-invoice/'.$payment_amt[0]['cart_id'].'?error');
            }
            
            
            
            // Or, print errors if the API request wasn't successful
        } else {
            redirect(base_url().'error');
            //echo "Transaction Failed \n";
            //$tresponse = $response->getTransactionResponse();
        
            if ($tresponse != null && $tresponse->getErrors() != null) {
              //  echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                //echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
            } else {
                //echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
                //echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
            }
        }
    } else {
        echo  "No response returned \n";
    }

    return $response;
}




//-----------------------------------------------------------------------------------------------------------------
function donation_charge($post)
{
    //merchant credentials live
    $MERCHANT_LOGIN_ID = "9mbW55hHyrM5";
    $MERCHANT_TRANSACTION_KEY = "7kyw78S849ES8vSj";
    //merchant credentials sandbox
    //$MERCHANT_LOGIN_ID = "65g9B7A5VFpM";
    //$MERCHANT_TRANSACTION_KEY = "7H6kDb29dXaHu647";
    $c_email = $post['email'];
    $c_address = '';
    $c_firstName = $post['firstname'];
    $c_lastName = $post['lastname'];
    $c_city = '';
    $c_state = '';
    $c_zip = '';
    //cart data
    $c_tracking = strtotime("now").mt_rand(10,99);
    $ss = $this->db->get_where('settings', array('id' => $post['pallets'] ))->result_array(); 
	if($post['pallets'] == 1)
    {
        $donated_is = 'Case';
    }
    if($post['pallets'] == 2)
    {
        $donated_is = 'Pallett';
    }
    if($post['pallets'] == 6)
    {
        $donated_is = 'Carton';
    }
    $total_bill = $post['qty'] * $ss[0]['value'];
    $t_fee = (3 / 100) * $total_bill;
    $amount = $total_bill + round($t_fee, 2);
    $c_card_date = $post['cc_exp_yr'] .'-'. $post['cc_exp_mo'];
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName($MERCHANT_LOGIN_ID);//MERCHANT_LOGIN_ID
    $merchantAuthentication->setTransactionKey($MERCHANT_TRANSACTION_KEY);//MERCHANT_TRANSACTION_KEY
    // Set the transaction's refId
    $refId = 'ref' . time();
    // Create the payment data for a credit card
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber(str_replace(' ', '',$post['cardNumber']));
    $creditCard->setExpirationDate($c_card_date);
    $creditCard->setCardCode($post['cardCvc']);
    // Add the payment data to a paymentType object
    $paymentOne = new AnetAPI\PaymentType();
    $paymentOne->setCreditCard($creditCard);
    // Create order information
    $order = new AnetAPI\OrderType();
    $order->setInvoiceNumber($c_tracking);
    $order->setDescription('Donation Milk For Mom');
    // Set the customer's Bill To address
    $customerAddress = new AnetAPI\CustomerAddressType();
    $customerAddress->setFirstName($c_firstName);
    $customerAddress->setLastName($c_lastName);
    $customerAddress->setCompany(" ");
    $customerAddress->setAddress($c_address);
    $customerAddress->setCity($c_city);
    $customerAddress->setState($c_state);
    $customerAddress->setZip($c_zip);
    $customerAddress->setCountry("USA");
    // Set the customer's identifying information
    $customerData = new AnetAPI\CustomerDataType();
    $customerData->setType("individual");
    $customerData->setId($c_tracking);
    $customerData->setEmail($c_email);
    // Add values for transaction settings
    $duplicateWindowSetting = new AnetAPI\SettingType();
    $duplicateWindowSetting->setSettingName("duplicateWindow");
    $duplicateWindowSetting->setSettingValue("60");
    // Add some merchant defined fields. These fields won't be stored with the transaction,
    // but will be echoed back in the response.
    $merchantDefinedField1 = new AnetAPI\UserFieldType();
    $merchantDefinedField1->setName("TrackingID");
    $merchantDefinedField1->setValue($c_tracking);
    //$merchantDefinedField2 = new AnetAPI\UserFieldType();
    //$merchantDefinedField2->setName("favoriteColor");
    //$merchantDefinedField2->setValue("blue");
    // Create a TransactionRequestType object and add the previous objects to it
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType("authCaptureTransaction");
    $transactionRequestType->setAmount($amount);
    $transactionRequestType->setOrder($order);
    $transactionRequestType->setPayment($paymentOne);
    //$transactionRequestType->setBillTo($c_address);
    //$transactionRequestType->setCustomer($_SESSION['user_id']);
    $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
    $transactionRequestType->addToUserFields($merchantDefinedField1);
    //$transactionRequestType->addToUserFields($merchantDefinedField2);
    // Assemble the complete transaction request
    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);
    // Create the controller and get the response
    $controller = new AnetController\CreateTransactionController($request);
    //$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
    // For PRODUCTION use
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
    if ($response != null) {
        // Check to see if the API request was successfully received and acted upon
        if ($response->getMessages()->getResultCode() == "Ok") {
            // Since the API request was successful, look for a transaction response
            // and parse it to display the results of authorizing the card
            $tresponse = $response->getTransactionResponse();
            $status_code = $tresponse->getResponseCode();
            if($status_code == 1)
            {
            //print_r($tresponse->getResponseCode());
            $this->db->insert('milk_donation', array('firstname'=> $post['firstname'], 'lastname' => $post['lastname'], 'email'=> $post['email'], 'phone'=>$post['phone'], 'pallets'=>$donated_is, 'amount'=>$amount, 'tracking' => $c_tracking, 'trx_id' => $tresponse->getTransId(), 'status'=> $tresponse->getResponseCode(), 'qty'=>$post['qty']  ));
            $this->db->insert('donation_tracking', array('tracking'=> $c_tracking, 'status'=> $tresponse->getResponseCode(), 'description' => 'Transaction Successfull' ));

              $to = $post['email'];
              $subject = 'Milk For Mom Donation';
              $body = '<h5>Dear '.$post['firstname'].' '.$post['lastname'].',</h5><p>Your have Donates '.$post['qty'].' '.$donated_is.' of milk Successfully You can track your Donation with Tracking ID: '.$c_tracking.'</p>';
              $from = '';
              $CI =& get_instance();
              $CI->Extension_model->email_queue($to, $subject, $body, $from);
              $to = 'clientservices@ourprintconnection.com';
              $subject = 'New Milk Donation For Mom';
              $body = '<p>You have new donation from '.$post['firstname'].' '.$post['lastname'].',</p><p>Your have Donates '.$post['qty'].' '.$donated_is.' of milk Tracking ID: '.$c_tracking.'</p>';
              $from = '';
              $CI =& get_instance();
              $CI->Extension_model->email_queue($to, $subject, $body, $from);
              redirect(base_url().'donate-milk?success&t='.$c_tracking);
            // Or, print errors if the API request wasn't successful
                }else
                {
                    redirect(base_url().'donate-milk?error');
                }
        } else {
                
            //echo "Transaction Failed \n";
            //$tresponse = $response->getTransactionResponse();
            if ($tresponse != null && $tresponse->getErrors() != null) {
                //echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                //echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
            } else {
                //echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
                //echo " Error Message : " . $response->getMessages()->getecMessage()[0]->getText() . "\n";
            }
            redirect(base_url().'donate-milk?error');
        }
    } else {
        echo  "No response returned \n";
        redirect(base_url().'donate-milk?error');
    }
    redirect(base_url().'donate-milk?error');
    return $response;
}

public function cart_info($id)
{
    $meta_info_cart = $this->db->get_where('cart_meta', array('cart_id'=>$id))->result_array();
    return $meta_info_cart;
}
public function customer_info($id)
{
    $customer_data = $this->db->get_where('user', array('user_id'=> $meta_info_cart[0]['customer_id']))->result_array();
    return $customer_data;
}

    //end class
}