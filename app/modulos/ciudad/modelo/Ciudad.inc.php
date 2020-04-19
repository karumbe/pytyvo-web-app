<?php
include_once 'app/nucleo/ModeloBase.inc.php';

class Ciudad extends ModeloBase {

    private $departamen;
    private $nombre_completo;

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
    * Código de departamento.
    *
    * @param boolean $vigente
    * Vigencia de la ciudad.
    *
    * @param string $nombre_completo
    * Nombre completo de la ciudad.
    */
    # @Override
    public function __construct($codigo = 0, $nombre = '', $departamen = 0,
            $vigente = false, $nombre_completo = '') {
        parent::__construct($codigo, $nombre, $vigente);
        $this->establecer_departamen($departamen);
        $this->establecer_nombre_completo($nombre_completo);
    }

    /**
    * Devuelve el código de departamento.
    *
    * @return integer
    */
    public function obtener_departamen() {
        return $this->departamen;
    }

    /**
    * Devuelve el nombre completo del modelo.
    *
    * @return string
    */
    public function obtener_nombre_completo() {
        return $this->nombre_completo;
    }

    /**
    * Establece el código de departamento.
    *
    * @param integer $departamen
    * Código de departamento.
    */
    public function establecer_departamen($departamen) {
        $this->departamen = $departamen;
    }

    /**
    * Establece el nombre completo del modelo.
    *
    * @param string $nombre_completo
    * Nombre completo del modelo.
    */
    public function establecer_nombre_completo($nombre_completo) {
        $this->nombre_completo = $nombre_completo;
    }

}
?>
