<?php
abstract class ModeloBase {

    protected $codigo;
    protected $nombre;
    protected $vigente;

    /**
    * Constructor.
    *
    * @param integer $codigo
    * Código del registro.
    *
    * @param string $nombre
    * Nombre del registro.
    *
    * @param boolean $vigente
    * Vigencia del registro.
    */
    public function __construct($codigo = 0, $nombre = '',
            $vigente = false) {
        $this->establecer_codigo($codigo);
        $this->establecer_nombre($nombre);
        $this->establecer_vigente($vigente);
    }

    /**
    * Devuelve el código del registro.
    *
    * @return integer
    */
    public function obtener_codigo() {
        return $this->codigo;
    }

    /**
    * Devuelve el nombre del registro.
    *
    * @return string
    */
    public function obtener_nombre() {
        return $this->nombre;
    }

    /**
    * Devuelve la vigencia del registro.
    *
    * @return boolean
    */
    public function esta_vigente() {
        return $this->vigente;
    }

    /**
    * Establece el código del registro.
    *
    * @param integer $codigo
    * Código del registro.
    */
    public function establecer_codigo($codigo) {
        $this->codigo = $codigo;
    }

    /**
    * Establece el nombre del registro.
    *
    * @param string $nombre
    * Nombre del registro.
    */
    public function establecer_nombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
    * Establece la vigencia del registro.
    *
    * @param boolean $vigente
    * Vigencia del registro.
    */
    public function establecer_vigente($vigente) {
        $this->vigente = $vigente;
    }

}
?>