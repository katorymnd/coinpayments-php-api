<?php
//include "coin_config.php";

include "coin_address.php";

class transact extends keys
{

    public function create_a_transaction($amount, $currency1, $currency2, $address, $item_name, $buyer_email, $buyer_name = null, $item_number,  $custom, $success_url, $cancel_url)
    {
        /**
         * Transaction details needed
         */
        $tior_request = array(
            'amount' => $amount, // in US dollars
            'currency1' => $currency1, // USD
            'currency2' => $currency2, // eg "BTC"
            'address' => $address, // coin pay address
            'item_name' => $item_name, // item name
            'buyer_email' => $buyer_email, // buyer email address
            'buyer_name' => $buyer_name, // buyer name {optional}
            'item_number' => $item_number, // item number or id
            'invoice' => random_int(1000, 9999), // invoice number {optonal}
            'custom' => $custom, // Details about the purchase product
            'success_url' => $success_url, // pay success url
            'cancel_url' => $cancel_url, // cancle payment url

        );

        return $this->trans_call_api('create_transaction', $tior_request);
    }

    private function trans_call_api($cmd, $tior_request = array())
    {


        $tior_request['version'] = 1;
        $tior_request['cmd'] = $cmd;
        $tior_request['key'] = $this->public_key();
        $tior_request['format'] = 'json'; //supported values are json and xml 

        $katorymnd_post_data = http_build_query($tior_request, '', '&');

        $katorymnd_hmac = hash_hmac('sha512', $katorymnd_post_data, $this->private_key());

        $katorymnd_bqsn = curl_init('https://www.coinpayments.net/api.php');
        curl_setopt($katorymnd_bqsn, CURLOPT_FAILONERROR, TRUE);
        curl_setopt($katorymnd_bqsn, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($katorymnd_bqsn, CURLOPT_SSL_VERIFYPEER, false); // chang this to "TRUE" for security reasons
        curl_setopt($katorymnd_bqsn, CURLOPT_HTTPHEADER, array('HMAC: ' . $katorymnd_hmac));
        curl_setopt($katorymnd_bqsn, CURLOPT_POSTFIELDS, $katorymnd_post_data);

        curl_exec($katorymnd_bqsn);
       

        curl_getinfo($katorymnd_bqsn);
        $katorymnd_zosm = curl_exec($katorymnd_bqsn);

        curl_close($katorymnd_bqsn);

        $spbk_array = json_decode($katorymnd_zosm, true); // get array 

        echo "<pre>";
        //print_r($spbk_array);  // get array
        $katorymnd_dkto = $spbk_array;

        return $katorymnd_dkto;
    }
}


$katorymnd_jcxz_payment = new transact;

/**
 * add transaction details 
 * Note: amount MUST be in US dollars
 * add details from a checkout point
 * 
 * save transaction id to the session or db to be called later
 */
$katorymnd_ltsi = $katorymnd_jcxz_payment->create_a_transaction(10.00, "USD", "LTCT", "your saved coin address here", "test pdt", "email@gmail.com", "jane doe", "KY-528",  "product payment", "https://example.com/success", "https://example.com/cancle"); // transaction details

print_r($katorymnd_ltsi);

/*
$lcnk = php_sapi_name() == 'cli' ? "\n" : '<br />';
print 'Transaction created with ID: ' . $katorymnd_ltsi['result']['txn_id'] . $lcnk;
print 'Buyer should send ' . sprintf('%.08f', $katorymnd_ltsi['result']['amount']) . ' LTCT' . $lcnk;
print 'Status URL: ' . $katorymnd_ltsi['result']['status_url'] . $lcnk;
print 'Checkout url: ' . $katorymnd_ltsi['result']['checkout_url'] . $lcnk; // good
print 'Qrcode url: ' . $katorymnd_ltsi['result']['qrcode_url'] . $lcnk;

print 'error status: ' . $katorymnd_ltsi['error'] . $lcnk;
*/