<?php
include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/Utiles.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/nucleo/Redireccion.inc.php';
include_once 'app/nucleo/Seguridad.inc.php';
include_once 'app/modulos/depar/modelo/Depar.inc.php';
include_once 'app/modulos/depar/modelo/DeparDaoFactory.inc.php';
include_once 'app/modulos/ciudad/modelo/Ciudad.inc.php';
include_once 'app/modulos/ciudad/modelo/CiudadDaoFactory.inc.php';
include_once dirname(__DIR__) . '/modelo/Barrio.inc.php';
include_once dirname(__DIR__) . '/modelo/BarrioDaoFactory.inc.php';
include_once dirname(__DIR__) . '/modelo/BarrioValidador.inc.php';

# inicio { declaración e inicialización de variables y constantes }
$entidad = 'barrio';
$entidad_repositorio = $entidad . 'DaoFactory';
$entidad_validador = $entidad . 'Validador';
$modulo = 'Barrio';

define('MODULO', 'barrio');
define('RUTA_ADMINISTRAR', RUTA_ADMINISTRAR_BARRIO);
define('RUTA_MANTENER', RUTA_MANTENER_BARRIO);
# fin { declaración e inicialización de variables y constantes }

$peticion = Utiles::obtener_peticion();

if (empty($peticion))
    Redireccion::redirigir(RUTA_ADMINISTRAR);

# inicio { seguridad del sistema }
if (!ControlSesion::sesion_iniciada())
    Redireccion::redirigir(RUTA_LOGIN);

if (isset($_POST['accion_solicitada']))
    if (!Seguridad::validar_token_csrf())
        Redireccion::redirigir(RUTA_ERROR_TOKEN_CSRF);

switch ($peticion) {
    case 'crear':
        if (!Seguridad::puede_agregar($_SESSION['cod_usuario'], MODULO))
            Redireccion::redirigir(RUTA_403);
        break;
    case 'actualizar':
        if (!Seguridad::puede_modificar($_SESSION['cod_usuario'], MODULO))
            Redireccion::redirigir(RUTA_403);
        break;
    case 'borrar':
        if (!Seguridad::puede_borrar($_SESSION['cod_usuario'], MODULO))
            Redireccion::redirigir(RUTA_403);
        break;
}
# fin { seguridad del sistema }

$repositorio = $entidad_repositorio::crear_dao();
$repositorio_departamen = DeparDaoFactory::crear_dao();
$repositorio_ciudad = CiudadDaoFactory::crear_dao();

if (is_null($repositorio) || is_null($repositorio_departamen) ||
        is_null($repositorio_ciudad))
    Redireccion::redirigir(RUTA_ADMINISTRAR);

if (isset($_POST['codigo']))
    if (Utiles::variable_iniciada($_POST['codigo'])) {
        $modelo =
            $repositorio->obtener_por_codigo((int) $_POST['codigo']);
        define('ESTA_RELACIONADO',
            $repositorio->esta_relacionado((int) $_POST['codigo']));
    }

if (isset($_POST['peticion'])) {
    if ($peticion === 'crear' || $peticion === 'actualizar') {
        $bandera = $peticion === 'crear' ? 1 : 2;
        $modelo = new $entidad(
            (int) $_POST['codigo'],
            (string) Utiles::limpiar_entrada($_POST['nombre']),
            (int) $_POST['departamen'],
            (int) $_POST['ciudad'],
            (boolean) isset($_POST['vigente']) &&
                $_POST['vigente'] === 'on' ? true : false,
            ''
        );
        $validador = new $entidad_validador(
            $bandera,
            $repositorio,
            $modelo
        );

        if ($validador->es_valido()) {
            $modelo = $validador->obtener_modelo();
            $dto = $repositorio->obtener_dto();

            # Convierte el objeto modelo a un DTO.
            if (!is_null($modelo) && !is_null($dto)) {
                $dto->EstablecerCodigo($modelo->obtener_codigo());
                $dto->EstablecerNombre(utf8_decode($modelo->obtener_nombre()));
                $dto->EstablecerDepartamen($modelo->obtener_departamen());
                $dto->EstablecerCiudad($modelo->obtener_ciudad());
                $dto->EstablecerVigente($modelo->esta_vigente());

                # Realiza la acción de crear o actualizar un registro.
                if ($peticion === 'crear')
                    $respuesta = $repositorio->agregar($_SESSION['cod_usuario'],
                        $dto);
                elseif ($peticion === 'actualizar')
                    $respuesta = $repositorio->modificar($_SESSION['cod_usuario'],
                        $dto);
            }
        }
    } elseif ($peticion === 'borrar') {
        $respuesta = $repositorio->borrar($_SESSION['cod_usuario'],
            $modelo->obtener_codigo());
        $mensaje = 'No se pudo eliminar el registro.';
    }

    if (isset($respuesta) && $respuesta)
        Redireccion::redirigir(RUTA_ADMINISTRAR);
}

/**
* Determina si recuperará todos los registros vigentes de las tablas
* relacionadas o si solo recuperará un registro de cada tabla relacionada.
*/
if ($peticion === 'crear' || $peticion === 'actualizar') {
    $departamentos = $repositorio_departamen->obtener_todos('vigente');

    if (isset($modelo) &&
            is_object($modelo) &&
            $modelo->obtener_departamen() > 0) {
        $ciudades = $repositorio_ciudad->obtener_todos(
            'a.vigente AND ' .
            'a.departamen == ' . $modelo->obtener_departamen()
        );
    }
}

if ($peticion === 'leer' || $peticion === 'borrar') {
    if (isset($modelo) && is_object($modelo)) {
        $cod_departamen = $modelo->obtener_departamen();
        $cod_ciudad = $modelo->obtener_ciudad();
    }

    $departamen = $repositorio_departamen->obtener_por_codigo($cod_departamen);
    $ciudad = $repositorio_ciudad->obtener_por_codigo($cod_ciudad);

    if (is_null($departamen))
        $departamen = new Depar();

    if (is_null($ciudad))
        $ciudad = new Ciudad();
}

$titulo = Utiles::obtener_titulo($peticion, $modulo);

include_once 'plantillas/documento_declaracion.inc.phtml';
include_once 'plantillas/navbar_modulos.inc.phtml';
include_once dirname(__DIR__) . '/vista/mantener.inc.phtml';
include_once 'plantillas/documento_pie.inc.phtml';
include_once 'plantillas/documento_javascript.inc.phtml';
include_once dirname(__DIR__) . '/vista/javascript.inc.phtml';
include_once 'plantillas/documento_cierre.inc.phtml';
?>
