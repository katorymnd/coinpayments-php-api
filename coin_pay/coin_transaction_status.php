<?php

//include "coin_config.php";

include "coin_config.php";


class payment_status extends keys
{


    public function check_payment_status($trans_id)
    {
        $tyqe_request = array(
            'txid' => $trans_id,
        );

        return $this->status_call_api('get_tx_info', $tyqe_request);
    }

    private function status_call_api($cmd, $tyqe_request = array())
    {

        $tyqe_request['version'] = 1;
        $tyqe_request['cmd'] = $cmd;
        $tyqe_request['key'] = $this->public_key();
        $tyqe_request['format'] = 'json'; //supported values are json and xml 

        $katorymnd_post_data = http_build_query($tyqe_request, '', '&');

        $katorymnd_hmac = hash_hmac('sha512', $katorymnd_post_data, $this->private_key());

        $katorymnd_juoi = curl_init('https://www.coinpayments.net/api.php');
        curl_setopt($katorymnd_juoi, CURLOPT_FAILONERROR, TRUE);
        curl_setopt($katorymnd_juoi, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($katorymnd_juoi, CURLOPT_SSL_VERIFYPEER, false); // chang this to "TRUE" for security reasons
        curl_setopt($katorymnd_juoi, CURLOPT_HTTPHEADER, array('HMAC: ' . $katorymnd_hmac));
        curl_setopt($katorymnd_juoi, CURLOPT_POSTFIELDS, $katorymnd_post_data);

        curl_exec($katorymnd_juoi);


        curl_getinfo($katorymnd_juoi);
        $katorymnd_ajhl = curl_exec($katorymnd_juoi);

        curl_close($katorymnd_juoi);

        $eupk_array = json_decode($katorymnd_ajhl, true); // get array 

        echo "<pre>";
        //print_r($eupk_array);  // get array

        $katorymnd_mpir = $eupk_array;

        return $katorymnd_mpir;
    }
}

$katorymnd_mudi = new payment_status;

/**
 * run this the request if you feel the payment must be completed by then
 * transection id from session
 */

$katorymnd_ofyu = $katorymnd_mudi->check_payment_status("tansaction id here"); // got from session

print_r($katorymnd_ofyu);

// details put to valuables
/*
$csqg = php_sapi_name() == 'cli' ? "\n" : '<br />';
print 'Transaction status: ' . $katorymnd_ofyu['result']['status_text'] . $csqg;
print 'Sent coins ' . sprintf('%.08f', $katorymnd_ofyu['result']['received']) . ' LTCT' . $csqg;
print 'Status: ' . $katorymnd_ofyu['result']['status'] . $csqg; // 100 -(means okay - successful)
*/
