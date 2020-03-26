<?php
class ControlSesion {

    public static function iniciar_sesion($cod_usuario, $usuario, $token) {
        if (session_id() == '') {
            session_start();
        }

        $_SESSION['cod_usuario'] = $cod_usuario;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['token'] = $token;
    }

    public static function cerrar_sesion() {
        if (session_id() == '') {
            session_start();
        }

        if (isset($_SESSION['cod_usuario'])) {
            unset($_SESSION['cod_usuario']);
        }

        if (isset($_SESSION['usuario'])) {
            unset($_SESSION['usuario']);
        }

        if (isset($_SESSION['token'])) {
            unset($_SESSION['token']);
        }

        session_destroy();
    }

    public static function sesion_iniciada() {
        if (session_id() == '') {
            session_start();
        }

        if (isset($_SESSION['cod_usuario']) && isset($_SESSION['usuario']) && isset($_SESSION['token'])) {
            return true;
        } else {
            return false;
        }
    }

}
?>