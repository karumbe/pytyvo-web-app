<?php
include_once 'app/nucleo/ModeloBase.inc.php';

class Ciudad extends ModeloBase {

    private $departamen;

    /**
    * Constructor.
    *
    * @param integer $codigo
    * Código de la ciudad.
    *
    * @param string $nombre
    * Nombre de la ciudad.
    *
    * @param integer $departamen
    * Código del departamento.
    *
    * @param boolean $vigente
    * Vigencia del registro.
    */
    # @Override
    public function __constructor($codigo, $nombre, $vigente,
            $departamen = 0) {
        parent::__constructor($codigo, $nombre, $vigente);
        $this->establecer_departamen($departamen);
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
    * Establece el código del departamento.
    *
    * @param integer $departamen
    * Código del departamento.
    */
    public function establecer_departamen($departamen) {
        $this->departamen = $departamen;
    }

}
?>