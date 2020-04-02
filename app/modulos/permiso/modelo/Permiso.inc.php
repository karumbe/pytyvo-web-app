<?php
class Permiso {

    private $usuario;
    private $modulo;
    private $acceder;
    private $agregar;
    private $modificar;
    private $borrar;
    private $imprimir;

    /**
    * Constructor.
    *
    * @param integer $usuario
    * Código del usuario.
    *
    * @param string $modulo
    * Nombre del módulo.
    *
    * @param boolean $acceder
    * Permiso para acceder.
    *
    * @param boolean $agregar
    * Permiso para agregar.
    *
    * @param boolean $modificar
    * Permiso para modificar.
    *
    * @param boolean $borrar
    * Permiso para borrar.
    *
    * @param boolean $imprimir
    * Permiso para imprimir.
    */
    public function __construct($usuario = 0, $modulo = '',
            $acceder = false, $agregar = false, $modificar = false,
            $borrar = false, $imprimir = false) {
        $this->establecer_usuario($usuario);
        $this->establecer_modulo($modulo);
        $this->establecer_acceder($acceder);
        $this->establecer_agregar($agregar);
        $this->establecer_modificar($modificar);
        $this->establecer_borrar($borrar);
        $this->establecer_imprimir($imprimir);
    }

    /**
    * Devuelve el código del usuario.
    *
    * @return integer
    */
    public function obtener_usuario() {
        return $this->usuario;
    }

    /**
    * Devuelve el nombre del módulo.
    *
    * @return string
    */
    public function obtener_modulo() {
        return $this->modulo;
    }

    /**
    * Devuelve el permiso para acceder.
    *
    * @return boolean
    */
    public function puede_acceder() {
        return $this->acceder;
    }

    /**
    * Devuelve el permiso para agregar.
    *
    * @return boolean
    */
    public function puede_agregar() {
        return $this->agregar;
    }

    /**
    * Devuelve el permiso para modificar.
    *
    * @return boolean
    */
    public function puede_modificar() {
        return $this->modificar;
    }

    /**
    * Devuelve el permiso para borrar.
    *
    * @return boolean
    */
    public function puede_borrar() {
        return $this->borrar;
    }

    /**
    * Devuelve el permiso para imprimir.
    *
    * @return boolean
    */
    public function puede_imprimir() {
        return $this->imprimir;
    }

    /**
    * Establece el código del usuario.
    *
    * @param integer $usuario
    * Código del usuario.
    */
    public function establecer_usuario($usuario) {
        $this->usuario = $usuario;
    }

    /**
    * Establece el nombre del módulo.
    *
    * @param string $modulo
    * Nombre del módulo.
    */
    public function establecer_modulo($modulo) {
        $this->modulo = $modulo;
    }

    /**
    * Establece el permiso para acceder.
    *
    * @param boolean $acceder
    * Permiso para acceder.
    */
    public function establecer_acceder($acceder) {
        $this->acceder = $acceder;
    }

    /**
    * Establece el permiso para agregar.
    *
    * @param boolean $agregar
    * Permiso para agregar.
    */
    public function establecer_agregar($agregar) {
        $this->agregar = $agregar;
    }

    /**
    * Establece el permiso para modificar.
    *
    * @param boolean $modificar
    * Permiso para modificar.
    */
    public function establecer_modificar($modificar) {
        $this->modificar = $modificar;
    }

    /**
    * Establece el permiso para borrar.
    *
    * @param boolean $borrar
    * Permiso para borrar.
    */
    public function establecer_borrar($borrar) {
        $this->borrar = $borrar;
    }

    /**
    * Establece el permiso para imprimir.
    *
    * @param boolean $imprimir
    * Permiso para imprimir.
    */
    public function establecer_imprimir($imprimir) {
        $this->imprimir = $imprimir;
    }

}
?>
