<?php
include_once 'app/nucleo/ModeloBase.inc.php';

class Ruta extends ModeloBase {

    private $sitios;

    /**
    * Constructor.
    *
    * @param integer $codigo
    * Código de la ruta.
    *
    * @param string $nombre
    * Nombre de la ruta.
    *
    * @param string $sitios
    * Sitios de la ruta.
    *
    * @param boolean $vigente
    * Vigencia del registro.
    */
    # @Override
    public function __constructor($codigo, $nombre, $vigente = false,
            $sitios = '') {
        parent::__constructor($codigo, $nombre, $vigente);
        $this->establecer_sitios($sitios);
    }

    /**
    * Devuelve los sitios de la ruta.
    *
    * @return string
    */
    public function obtener_sitios() {
        return $this->sitios;
    }

    /**
    * Establece los sitios de la ruta.
    *
    * @param string $sitios
    * Sitios de la ruta.
    */
    public function establecer_sitios($sitios) {
        $this->sitios = $sitios;
    }

}
?>