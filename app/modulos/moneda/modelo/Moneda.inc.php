<?php
include_once 'app/nucleo/ModeloBase.inc.php';

class Moneda extends ModeloBase {

    private $simbolo;
    private $decimales;

    /**
    * Constructor.
    *
    * @param integer $codigo
    * Código del registro.
    *
    * @param string $nombre
    * Nombre del registro.
    *
    * @param string $simbolo
    * Símbolo de la moneda.
    *
    * @param boolean $decimales
    * Decimales de la moneda.
    *
    * @param boolean $vigente
    * Vigencia del registro.
    */
    public function __construct($codigo = 0, $nombre = '', $simbolo = '',
            $decimales = false, $vigente = false) {
        parent::__construct($codigo, $nombre, $vigente);
        $this->establecer_simbolo($simbolo);
        $this->establecer_decimales($decimales);
    }

    /**
    * Devuelve el símbolo de la moneda.
    *
    * @return string
    */
    public function obtener_simbolo() {
        return $this->simbolo;
    }

    /**
    * Devuelve si la moneda utiliza decimales.
    *
    * @return boolean
    */
    public function utiliza_decimales() {
        return $this->decimales;
    }

    /**
    * Establece el símbolo de la moneda.
    *
    * @param string $simbolo
    * Símbolo de la moneda.
    */
    public function establecer_simbolo($simbolo) {
        $this->simbolo = $simbolo;
    }

    /**
    * Establece si la moneda utiliza decimales.
    *
    * @param boolean $decimales
    * Decimales de la moneda.
    */
    public function establecer_decimales($decimales) {
        $this->decimales = $decimales;
    }

}
?>
