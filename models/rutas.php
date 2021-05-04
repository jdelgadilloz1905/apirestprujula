<?php

class Ruta{

	/*=============================================
	RUTA PARA ACCEDER AL TEMPLATE SIN HTTPS
	=============================================*/
	static public function ctrRutaEnvioEmail(){

		//return "https://www.prujula.pr/";
		return "https://prujula-site.herokuapp.com/register-sucess";

	}

    static public function ctrRutaBackend(){

        //return "http://localhost/apirestprujula/";
        return "https://www.estudio57.net/apirestprujula/";

    }

}