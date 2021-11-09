<?php

include "coin_config.php";

/**
 *  create a new deposit address for a desired currency
 * Link to the related documentation https://www.coinpayments.net/apidoc-get-deposit-address
 * 
 */


class deposit_address extends  keys
{



    public function get_address($currency)
    {
        $request = array(
            'currency' => $currency,
        );

        return $this->call_api('get_deposit_address', $request);
    }

    private function call_api($cmd, $request = array())
    {


        /**
         * To get the deposit coin address, we need "cmd and "currency" plus " api keys"
         *  "currency" -> to the coin short code eg (LTCT)
         * 
         * Update the currency to "BTC" or any you want when you go live
         */
        $request['version'] = 1;
        $request['cmd'] = $cmd;
        $request['key'] = $this->public_key();
        $request['format'] = 'json'; //supported values are json and xml 


        $katorymnd_post_data = http_build_query($request, '', '&');


        $katorymnd_hmac = hash_hmac('sha512', $katorymnd_post_data, $this->private_key());

        // Use curl to hit the endpoint so that you can send the required headers 
        $katorymnd_ch = curl_init('https://www.coinpayments.net/api.php');
        curl_setopt($katorymnd_ch, CURLOPT_FAILONERROR, TRUE);
        curl_setopt($katorymnd_ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($katorymnd_ch, CURLOPT_SSL_VERIFYPEER, false); // chang this to "TRUE" for security reasons
        curl_setopt($katorymnd_ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $katorymnd_hmac));
        curl_setopt($katorymnd_ch, CURLOPT_POSTFIELDS, $katorymnd_post_data);


        curl_exec($katorymnd_ch);

        curl_getinfo($katorymnd_ch);
        $katorymnd_dfiz = curl_exec($katorymnd_ch);

        curl_close($katorymnd_ch);

        $tamo_array = json_decode($katorymnd_dfiz, true); // get array 

        echo "<pre>";
        $katorymnd_dkto  = $tamo_array;  // get array

        // $katorymnd_dkto = $tamo_array['result']['address']; // actual coinpayment address

        return $katorymnd_dkto;
    }
}


$payment_address = new deposit_address;
print_r($payment_address->get_address('LTCT')); // or "BTC"
