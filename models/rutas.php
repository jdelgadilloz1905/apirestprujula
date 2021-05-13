<?php

class Ruta{

	/*=============================================
	RUTA PARA ACCEDER AL TEMPLATE SIN HTTPS
	=============================================*/
	static public function ctrRutaEnvioEmailAuth(){

		//return "https://www.prujula.pr/";
		return "https://prujula-site.herokuapp.com/auth/";

	}
    static public function ctrRutaFront(){

        //return "https://www.prujula.pr/";
        return "https://prujula-site.herokuapp.com/";

    }


    static public function ctrRutaBackend(){

        //return "http://localhost/apirestprujula/";
        return "https://www.estudio57.net/apirestprujula/";

    }

}