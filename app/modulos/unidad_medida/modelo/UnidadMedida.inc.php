<?php
include_once 'app/nucleo/ModeloBase.inc.php';

class UnidadMedida extends ModeloBase {

    private $simbolo;
    private $divisible;

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
    * Símbolo de la unidad de medida.
    *
    * @param boolean $divisible
    * Divisibilidad de la unidad de medida.
    *
    * @param boolean $vigente
    * Vigencia del registro.
    */
    public function __construct($codigo = 0, $nombre = '', $simbolo = '',
            $divisible = false, $vigente = false) {
        parent::__construct($codigo, $nombre, $vigente);
        $this->establecer_simbolo($simbolo);
        $this->establecer_divisible($divisible);
    }

    /**
    * Devuelve el símbolo de la unidad de medida.
    *
    * @return string
    */
    public function obtener_simbolo() {
        return $this->simbolo;
    }

    /**
    * Devuelve la divisibilidad de la unidad de medida.
    *
    * @return boolean
    */
    public function es_divisible() {
        return $this->divisible;
    }

    /**
    * Establece el símbolo de la unidad de medida.
    *
    * @param string $simbolo
    * Símbolo de la unidad de medida.
    */
    public function establecer_simbolo($simbolo) {
        $this->simbolo = $simbolo;
    }

    /**
    * Establece la divisibilidad de la unidad de medida.
    *
    * @param boolean $divisible
    * Divisibilidad de la unidad de medida.
    */
    public function establecer_divisible($divisible) {
        $this->divisible = $divisible;
    }

}
?>
