<?php

require "../../payments/payment_settings.php";


/**
 * set api keys for coinpayments
 *  from your API Keys page
 * https://www.coinpayments.net/merchant-tools-ipn#setup
 * 
 * Keys are required for every  process
 */


class  keys extends api_details
{
    //public_key - update me
    private $katorymnd_giyu = "147c7139980cd75ee0784f2fed8a761a68f22ff0d3e75b769f90f8f26bd96e04";

    // private key - update me
    private $katorymnd_nkag = "06fBae51daee0fe66C64A806A73Fce8869aD972aA2D4b1e74E6209Ce540DF974";

    public function public_key()
    {
        $this->katorymnd_tafy('public_key', $this->katorymnd_giyu);
        return $this->katorymnd_array()['public_key'];
    }

    public function private_key()
    {
        $this->katorymnd_tafy('private_key', $this->katorymnd_nkag);
        return $this->katorymnd_array()['private_key'];
    }
}
