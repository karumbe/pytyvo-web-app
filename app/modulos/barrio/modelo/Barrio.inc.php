<?php
include_once 'app/nucleo/ModeloBase.inc.php';

class Barrio extends ModeloBase {

    private $departamen;
    private $ciudad;
    private $nombre_completo;

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
    * Vigencia del barrio.
    *
    * @param string $nombre_completo
    * Nombre completo del barrio.
    */
    # @Override
    public function __construct($codigo = 0, $nombre = '', $departamen = 0,
            $ciudad = 0, $vigente = false, $nombre_completo = '') {
        parent::__construct($codigo, $nombre, $vigente);
        $this->establecer_departamen($departamen);
        $this->establecer_ciudad($ciudad);
        $this->establecer_nombre_completo($nombre_completo);
    }

    /**
    * Devuelve el código de la departamento.
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
    * Devuelve el nombre completo del modelo.
    *
    * @return string
    */
    public function obtener_nombre_completo() {
        return $this->nombre_completo;
    }

    /**
    * Establece el código de la departamento.
    *
    * @param integer $departamen
    * Código de la departamento.
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
