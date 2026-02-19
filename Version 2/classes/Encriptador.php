<?php
class Encriptador {

    private $clave = "claveMedica";

    function encripta($texto){
        $resultado = "";
        for($i=0; $i<strlen($texto); $i++){
            $ascii = ord($texto[$i]);
            $ascii += ord($this->clave[$i % strlen($this->clave)]) % 10;
            $resultado .= chr($ascii);
        }
        return base64_encode($resultado);
    }

    function desencripta($texto){
        $texto = base64_decode($texto);
        $resultado = "";
        for($i=0; $i<strlen($texto); $i++){
            $ascii = ord($texto[$i]);
            $ascii -= ord($this->clave[$i % strlen($this->clave)]) % 10;
            $resultado .= chr($ascii);
        }
        return $resultado;
    }
}
?>

