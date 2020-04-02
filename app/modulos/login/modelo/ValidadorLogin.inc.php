<?php
include_once 'app/nucleo/Utiles.inc.php';
include_once 'app/modulos/usuario/modelo/UsuarioDaoFactory.inc.php';

class ValidadorLogin {

    private $usuario;
    private $token;
    private $error;

    /**
    * Constructor.
    *
    * @param string $nombre
    * Nombre de usuario.
    *
    * @param string $clave
    * Contraseña.
    *
    * @param string $token
    * Token de seguridad.
    */
    public function __construct($nombre, $clave, $token) {
        $this->error = '';

        if (!Utiles::variable_iniciada($nombre) ||
                !Utiles::variable_iniciada($clave) ||
                !Utiles::variable_iniciada($token)) {
            $this->usuario = null;
            $this->token = null;
            $this->error = 'Debe ingresar su nombre de usuario y contraseña.';
        } else {
            $repositorio = UsuarioDaoFactory::crear_dao();
            $this->usuario = $repositorio->obtener_por_usuario($nombre);
            $this->token = $token;

            if (is_null($this->usuario) ||
                    $clave !== $this->usuario->obtener_clave()) {
                $this->error = 'Nombre de usuario o contraseña incorrectos.';
            } else if (!$this->usuario->esta_vigente()) {
                $this->error = 'La cuenta que intenta utilizar está bloqueda.';
            }
        }
    }

    /**
    * Devuelve el objeto usuario.
    *
    * @return object
    */
    public function obtener_usuario() {
        return $this->usuario;
    }

    /**
    * Devuelve el token de seguridad.
    *
    * @return string
    */
    public function obtener_token() {
        return $this->token;
    }

    /**
    * Devuelve el mensaje de error.
    *
    * @return string
    */
    public function obtener_error() {
        return $this->error;
    }

    /**
    * Muestra el mensaje de error.
    *
    * @return void
    */
    public function mostrar_error() {
        if ($this->error !== '') {
            echo '<div class="alert alert-danger alerta-peligro" role="alert" id="error-login">';
            echo $this->error;
            echo '</div>';
        }
    }

}
?>
