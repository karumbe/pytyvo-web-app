<?php
include_once 'app/nucleo/ModeloBase.inc.php';

class Modelo extends ModeloBase {

    private $maquina;
    private $marca;
    private $nombre_completo;

    /**
    * Constructor.
    *
    * @param integer $codigo
    * Código del modelo.
    *
    * @param string $nombre
    * Nombre del modelo.
    *
    * @param integer $maquina
    * Código de la máquina.
    *
    * @param integer $marca
    * Código de la marca.
    *
    * @param boolean $vigente
    * Vigencia del modelo.
    *
    * @param string $nombre_completo
    * Nombre completo del modelo.
    */
    # @Override
    public function __construct($codigo = 0, $nombre = '', $maquina = 0,
            $marca = 0, $vigente = false, $nombre_completo = '') {
        parent::__construct($codigo, $nombre, $vigente);
        $this->establecer_maquina($maquina);
        $this->establecer_marca($marca);
        $this->establecer_nombre_completo($nombre_completo);
    }

    /**
    * Devuelve el código de la máquina.
    *
    * @return integer
    */
    public function obtener_maquina() {
        return $this->maquina;
    }

    /**
    * Devuelve el código de la marca.
    *
    * @return integer
    */
    public function obtener_marca() {
        return $this->marca;
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
    * Establece el código de la máquina.
    *
    * @param integer $maquina
    * Código de la máquina.
    */
    public function establecer_maquina($maquina) {
        $this->maquina = $maquina;
    }

    /**
    * Establece el código de la marca.
    *
    * @param integer $marca
    * Código de la marca.
    */
    public function establecer_marca($marca) {
        $this->marca = $marca;
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
