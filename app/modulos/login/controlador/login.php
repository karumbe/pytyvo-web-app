<?php
require_once 'app/lib/random.inc.php';
include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/Utiles.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/nucleo/Redireccion.inc.php';
include_once dirname(__DIR__) . '/modelo/ValidadorLogin.inc.php';

if (ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}

if (isset($_POST['login'])) {
    $validador = new ValidadorLogin(
        Utiles::limpiar_entrada($_POST['nombre']),
        Utiles::limpiar_entrada($_POST['clave']),
        $_POST['token']
    );

    if ($validador->obtener_error() === '' &&
            !is_null($validador->obtener_usuario())) {
        ControlSesion::iniciar_sesion(
            $validador->obtener_usuario()->obtener_codigo(),
            $validador->obtener_usuario()->obtener_nombre(),
            $validador->obtener_token()
        );

        Redireccion::redirigir(SERVIDOR);
    }
}

$titulo = 'Bienvenido';

include_once 'plantillas/documento_declaracion.inc.phtml';
include_once dirname(__DIR__) . '/vista/login.inc.phtml';
include_once 'plantillas/documento_pie.inc.phtml';
include_once 'plantillas/documento_javascript.inc.phtml';
include_once dirname(__DIR__) . '/vista/javascript.inc.phtml';
include_once 'plantillas/documento_cierre.inc.phtml';
?>
