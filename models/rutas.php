<?php

class Ruta{

	/*=============================================
	RUTA PARA ACCEDER AL TEMPLATE SIN HTTPS
	=============================================*/
	static public function ctrRutaEnvioEmailAuth(){

		//return "https://www.prujula.pr/";
		return "https://prujula-site.herokuapp.com/auth/";

	}

	static public function ctrRutaEnvioEmailConfirm(){

        return "https://prujula-site.herokuapp.com/profile/payment/confirm-reservation/";
    }

    static public function ctrRutaFront(){

        //return "https://www.prujula.pr/";
        //return "https://www.prujula.estudio57.net/";
        return "https://prujula-site.herokuapp.com/";

    }


    static public function ctrRutaBackend(){

        //return "http://localhost/apirestprujula/";
        return "https://www.estudio57.net/apirestprujula/";

    }



    static public function apiAlgolia(){

        $client = \Algolia\AlgoliaSearch\SearchClient::create('05MH8B5SSN', '9dec337c2fcc9a7915066dd1dfd4bb7a'); //desarrollo

        //$client = \Algolia\AlgoliaSearch\SearchClient::create('RK5WGMMT2Y', '5faaffff77e964237ab79653cb5057ba'); //produccion

        return $client;
    }

    static public function apiAccepta(){

        return "https://api.ezpaycenters.net/api/cc";
    }

}