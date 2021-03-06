<?php
header('Content-Type: application/json');

include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/nucleo/Seguridad.inc.php';
include_once 'app/modulos/motivo_clie/modelo/MotivoClieDaoFactory.inc.php';

# inicio { validaciones }
if (!ControlSesion::sesion_iniciada()) {
    $respuesta = array('info' => array('ok' => false,
                                       'estado' => 'fallo',
                                       'mensaje' => HTTP_401_NO_AUTORIZADO));
    die(json_encode($respuesta));
}

if (!Seguridad::puede_acceder($_SESSION['cod_usuario'], 'motivo_clie')) {
    $respuesta = array('info' => array('ok' => false,
                                       'estado' => 'fallo',
                                       'mensaje' => HTTP_403_PROHIBIDO));
    die(json_encode($respuesta));
}

$repositorio = MotivoClieDaoFactory::crear_dao();

if (is_null($repositorio)) {
    $respuesta = array('info' => array('ok' => false,
                                       'estado' => 'fallo',
                                       'mensaje' => HTTP_503_SERVICIO_NO_DISPONIBLE));
    die(json_encode($respuesta));
}

if (!isset($_POST['nombre'])) {
    $respuesta = array('info' => array('ok' => false,
                                       'estado' => 'fallo',
                                       'mensaje' => ERROR_1229));
    die(json_encode($respuesta));
}
# fin { validaciones }

$nombre_existe = $repositorio->nombre_existe($_POST['nombre']);
$respuesta = array('info' => array('ok' => true,
                                   'estado' => 'exito',
                                   'mensaje' => $nombre_existe));
echo json_encode($respuesta);
?>
