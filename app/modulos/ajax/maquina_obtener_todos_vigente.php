<?php
header('Content-Type: application/json');

include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/nucleo/Seguridad.inc.php';
include_once 'app/modulos/maquina/modelo/MaquinaDaoFactory.inc.php';

# inicio { validaciones }
if (!ControlSesion::sesion_iniciada()) {
    $respuesta = array('info' => array('ok' => false,
                                       'estado' => 'fallo',
                                       'mensaje' => HTTP_401_NO_AUTORIZADO));
    die(json_encode($respuesta));
}

if (!Seguridad::puede_acceder($_SESSION['cod_usuario'], 'maquina')) {
    $respuesta = array('info' => array('ok' => false,
                                       'estado' => 'fallo',
                                       'mensaje' => HTTP_403_PROHIBIDO));
    die(json_encode($respuesta));
}

$repositorio = MaquinaDaoFactory::crear_dao();

if (is_null($repositorio)) {
    $respuesta = array('info' => array('ok' => false,
                                       'estado' => 'fallo',
                                       'mensaje' => HTTP_503_SERVICIO_NO_DISPONIBLE));
    die(json_encode($respuesta));
}
# fin { validaciones }

$maquinas = array();
$filas = $repositorio->obtener_todos('vigente');

foreach ($filas as $fila) {
    $maquinas[] = array('codigo' => (int) $fila->obtener_codigo(),
                        'nombre' => (string) $fila->obtener_nombre(),
                        'vigente' => (bool) $fila->esta_vigente());
}

$respuesta = array('info' => array('ok' => true,
                                   'estado' => 'exito',
                                   'resultados' => count($maquinas),
                                   'version' => '1.0'),
                   'resultados' => $maquinas);

echo json_encode($respuesta);
?>
