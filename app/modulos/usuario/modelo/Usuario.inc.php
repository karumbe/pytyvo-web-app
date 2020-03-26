<?php
include_once 'app/nucleo/ModeloBase.inc.php';

class Usuario extends ModeloBase {

    private $clave;

    /**
    * Constructor.
    *
    * @param integer $codigo
    * Código del usuario.
    *
    * @param string $nombre
    * Nombre del usuario.
    *
    * @param string $usuario
    * Nombre de usuario.
    *
    * @param string $clave
    * Contraseña.
    *
    * @param boolean $vigente
    * Vigencia del usuario.
    */
    # @Override
    public function __constructor($codigo, $nombre, $vigente, $usuario = '',
            $clave = '') {
        parent::__constructor($codigo, $nombre, $vigente);
        $this->establecer_usuario($usuario);
        $this->establecer_clave($clave);
    }

    /**
    * Devuelve el nombre de usuario.
    *
    * @return string
    */
    public function obtener_usuario() {
        return $this->usuario;
    }

    /**
    * Devuelve la contraseña.
    *
    * @return string
    */
    public function obtener_clave() {
        return $this->clave;
    }

    /**
    * Establece el nombre de usuario.
    *
    * @param string $usuario
    * Nombre de usuario.
    */
    public function establecer_usuario($usuario) {
        $this->usuario = $usuario;
    }

    /**
    * Establece la contraseña.
    *
    * @param string $clave
    * Contraseña.
    */
    public function establecer_clave($clave) {
        $this->clave = $clave;
    }

}
?>