<?php
class Encriptador {

    private $clave = "claveMedica";

    // MÉTODO 1 → Base64 simple
    public function encriptaBase64($texto){
        return base64_encode($texto);
    }

    public function desencriptaBase64($texto){
        return base64_decode($texto);
    }

    // MÉTODO 2 → Cifrado con clave
    public function encriptaClave($texto){
        $resultado = "";
        for($i = 0; $i < strlen($texto); $i++){
            $ascii = ord($texto[$i]);
            $ascii += ord($this->clave[$i % strlen($this->clave)]) % 10;
            $resultado .= chr($ascii);
        }
        return base64_encode($resultado);
    }

    public function desencriptaClave($texto){
        $texto = base64_decode($texto);
        $resultado = "";
        for($i = 0; $i < strlen($texto); $i++){
            $ascii = ord($texto[$i]);
            $ascii -= ord($this->clave[$i % strlen($this->clave)]) % 10;
            $resultado .= chr($ascii);
        }
        return $resultado;
    }
}
?>

