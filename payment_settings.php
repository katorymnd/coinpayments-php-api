<?php

/**
 * the class will out put a  keys and vlaues as needed
 *  to get this done 
 * 1. set  array at ($katorymnd_payment->katorymnd_tafy('phone', "0753123456");)
 * 2. to get the only the value  call ($katorymnd_payment->katorymnd_array()['phone']; or $katorymnd_payment->katorymnd_array('phone'))
 * will give (0753123456) for the value
 * 3. get array  (print_r($katorymnd_payment->katorymnd_array()))
 * 
 */

trait payment_api
{
    private $katorymnd_mlpv; //=array('abc'=>'ABC Variable', 'def'=>'Def Variable');


    public function katorymnd_tafy($smny_key, $blx_value) // set array
    {
        $this->katorymnd_mlpv[$smny_key] = $blx_value;
    }

    private function katorymnd_qyxi($smny_key) // get array with smny_key {Array ( [phone] => 0753123456 [nams] => hshs ) }
    {
        return $this->katorymnd_mlpv[$smny_key];
    }
    private function katorymnd_sbia() // get without smny_key {0753123456}
    {
        return $this->katorymnd_mlpv;
    }

    //Method Overloading in PHP

    public function __call($method, $arguments)
    {
        if ($method == 'katorymnd_array') {
            if (count($arguments) == 0) {
                return $this->katorymnd_sbia();
            } elseif (count($arguments) == 1) {
                return $this->katorymnd_qyxi(implode(',', $arguments));
            }
        }
    }
}


class api_details
{
    use payment_api;
}


/* Setting and getting values of array-> katorymnd_mlpv[] */

$katorymnd_payment =  new api_details;

//$katorymnd_payment->katorymnd_tafy('country', 'Uganda');// set array
//$katorymnd_payment->katorymnd_tafy('address', 'Mukono');// set array
//$katorymnd_payment->katorymnd_tafy('phone', "0753123456"); // set array
//$katorymnd_payment->katorymnd_tafy('name', "Raymond"); // set array

//echo $katorymnd_payment->katorymnd_array('phone') . "<br>"; //get blx_value
//echo $katorymnd_payment->katorymnd_array('name') . "<br>";

//print_r($katorymnd_payment->katorymnd_array());
//print $katorymnd_payment->katorymnd_array()['phone'];

//echo "<br>";
