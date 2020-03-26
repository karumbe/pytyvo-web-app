<?php
header('Content-Type: application/json');

include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/modulos/motivo_clie/modelo/MotivoClieDaoFactory.inc.php';

# inicio { validaciones }
if (!ControlSesion::sesion_iniciada()) {
    $respuesta = array('info' => array('ok' => false,
                                    'estado' => 'fallido',
                                    'mensaje' => 'Acceso denegado.'));
    die(json_encode($respuesta));
}

if (!isset($_POST['nombre'])) {
    $respuesta = array('info' => array('ok' => false,
                                    'estado' => 'fallido',
                                    'mensaje' => 'Muy pocos argumentos.'));
    die(json_encode($respuesta));
}

$repositorio = MotivoClieDaoFactory::crear_dao();

if (is_null($repositorio)) {
    $respuesta = array('info' => array('ok' => false,
                                    'estado' => 'fallido',
                                    'mensaje' => 'No se pudo crear el objeto repositorio.'));
    die(json_encode($respuesta));
}
# fin { validaciones }

$nombre_existe = $repositorio->nombre_existe($_POST['nombre']);
$respuesta = array('nombre_existe' => $nombre_existe);

echo json_encode($respuesta);
?>