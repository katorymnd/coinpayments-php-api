<?php
/**
 * get all the set coins you accept from your coinpayment account
 * 
 * All coins you accept are set {[accepted] => 1}
 */

include "coin_config.php";


class your_coins extends  keys
{



    public function get_coins()
    {
        $fnzs_request = array(
            'accepted' => 2,
            'short' => 1,

        );

        return $this->coins_call_api('rates', $fnzs_request);
    }

    private function coins_call_api($cmd, $fnzs_request = array())
    {
       
        $fnzs_request['version'] = 1;
        $fnzs_request['cmd'] = $cmd;
        $fnzs_request['key'] = $this->public_key();
        $fnzs_request['format'] = 'json'; //supported values are json and xml 

        // Generate the query string 
        $katorymnd_post_data = http_build_query($fnzs_request, '', '&');

        // Calculate the HMAC signature on the POST data 
        $katorymnd_hmac = hash_hmac('sha512', $katorymnd_post_data, $this->private_key());

        // Use curl to hit the endpoint so that you can send the required headers 
        $katorymnd_viyg = curl_init('https://www.coinpayments.net/api.php');
        curl_setopt($katorymnd_viyg, CURLOPT_FAILONERROR, TRUE);
        curl_setopt($katorymnd_viyg, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($katorymnd_viyg, CURLOPT_SSL_VERIFYPEER, false); // chang this to "TRUE" for security reasons
        curl_setopt($katorymnd_viyg, CURLOPT_HTTPHEADER, array('HMAC: ' . $katorymnd_hmac));
        curl_setopt($katorymnd_viyg, CURLOPT_POSTFIELDS, $katorymnd_post_data);

        // Execute the call and close cURL handle      
        curl_exec($katorymnd_viyg);

        // dump the data returned back from coinpayments
        //var_dump($data);

        curl_getinfo($katorymnd_viyg);
        $katorymnd_dfiz = curl_exec($katorymnd_viyg);

        curl_close($katorymnd_viyg);

        $tamo_array = json_decode($katorymnd_dfiz, true); // get array 
        
        echo "<pre>";
        //print_r($tamo_array);  // get array

        $katorymnd_vokh = $tamo_array;
        
        return $katorymnd_vokh;
    }
}


$katorymnd_afcr = new your_coins;
$katorymnd_ivsj = $katorymnd_afcr->get_coins(); //

print_r($katorymnd_ivsj);
