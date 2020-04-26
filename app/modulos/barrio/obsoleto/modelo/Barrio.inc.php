<?php
include_once 'app/nucleo/ModeloBase.inc.php';

class Barrio extends ModeloBase {

    private $departamen;
    private $ciudad;

    /**
    * Constructor.
    *
    * @param integer $codigo
    * Código del barrio.
    *
    * @param string $nombre
    * Nombre del barrio.
    *
    * @param integer $departamen
    * Código del departamento.
    *
    * @param integer $ciudad
    * Código de la ciudad.
    *
    * @param boolean $vigente
    * Vigencia del registro.
    */
    # @Override
    public function __constructor($codigo, $nombre, $vigente,
            $departamen = 0, $ciudad = 0) {
        parent::__constructor($codigo, $nombre, $vigente);
        $this->establecer_departamen($departamen);
        $this->establecer_ciudad($ciudad);
    }

    /**
    * Devuelve el código del departamento.
    *
    * @return integer
    */
    public function obtener_departamen() {
        return $this->departamen;
    }

    /**
    * Devuelve el código de la ciudad.
    *
    * @return integer
    */
    public function obtener_ciudad() {
        return $this->ciudad;
    }

    /**
    * Establece el código del departamento.
    *
    * @param integer $departamen
    * Código del departamento.
    */
    public function establecer_departamen($departamen) {
        $this->departamen = $departamen;
    }

    /**
    * Establece el código de la ciudad.
    *
    * @param integer $ciudad
    * Código de la ciudad.
    */
    public function establecer_ciudad($ciudad) {
        $this->ciudad = $ciudad;
    }

}
?>