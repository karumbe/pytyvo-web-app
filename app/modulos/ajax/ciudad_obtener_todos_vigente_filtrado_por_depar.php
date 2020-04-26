<?php
header('Content-Type: application/json');

include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/nucleo/Seguridad.inc.php';
include_once 'app/modulos/ciudad/modelo/CiudadDaoFactory.inc.php';

# inicio { validaciones }
if (!ControlSesion::sesion_iniciada()) {
    $respuesta = array('info' => array('ok' => false,
                                       'estado' => 'fallo',
                                       'mensaje' => HTTP_401_NO_AUTORIZADO));
    die(json_encode($respuesta));
}

if (!Seguridad::puede_acceder($_SESSION['cod_usuario'], 'ciudad')) {
    $respuesta = array('info' => array('ok' => false,
                                       'estado' => 'fallo',
                                       'mensaje' => HTTP_403_PROHIBIDO));
    die(json_encode($respuesta));
}

if (!isset($_GET['departamen'])) {
    $respuesta = array('info' => array('ok' => false,
                                       'estado' => 'fallo',
                                       'mensaje' => 'Departamento no válido.'));
    die(json_encode($respuesta));
} else {
    $departamen = (int) $_GET['departamen'];

    if ($departamen <= 0 || $departamen > 999) {
        $respuesta = array('info' => array('ok' => false,
                                           'estado' => 'fallo',
                                           'mensaje' => 'Departamento no válido.'));
        die(json_encode($respuesta));
    }
}

$repositorio = CiudadDaoFactory::crear_dao();

if (is_null($repositorio)) {
    $respuesta = array('info' => array('ok' => false,
                                       'estado' => 'fallo',
                                       'mensaje' => HTTP_503_SERVICIO_NO_DISPONIBLE));
    die(json_encode($respuesta));
}
# fin { validaciones }

$registros = array();
$filas = $repositorio->obtener_todos('a.vigente AND a.departamen == ' . $departamen);

foreach ($filas as $fila) {
    $registros[] = array('codigo' => (int) $fila->obtener_codigo(),
                         'nombre' => (string) $fila->obtener_nombre(),
                         'departamen' => (int) $fila->obtener_departamen(),
                         'vigente' => (bool) $fila->esta_vigente());
}

$respuesta = array('info' => array('ok' => true,
                                   'estado' => 'exito',
                                   'resultados' => count($registros),
                                   'version' => '1.0'),
                   'resultados' => $registros);

echo json_encode($respuesta);
?>
