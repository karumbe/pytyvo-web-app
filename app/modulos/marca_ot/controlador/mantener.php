<?php
include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/Utiles.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/nucleo/Redireccion.inc.php';
include_once 'app/nucleo/Seguridad.inc.php';
include_once dirname(__DIR__) . '/modelo/MarcaOt.inc.php';
include_once dirname(__DIR__) . '/modelo/MarcaOtDaoFactory.inc.php';
include_once dirname(__DIR__) . '/modelo/MarcaOtValidador.inc.php';

# inicio { declaración e inicialización de variables y constantes }
$entidad = 'MarcaOt';
$entidad_repositorio = $entidad . 'DaoFactory';
$entidad_validador = $entidad . 'Validador';
$modulo = 'Marca';

define('MODULO', 'marca_ot');
define('RUTA_ADMINISTRAR', RUTA_ADMINISTRAR_MARCA_OT);
define('RUTA_MANTENER', RUTA_MANTENER_MARCA_OT);
# fin { declaración e inicialización de variables y constantes }

$peticion = Utiles::obtener_peticion();

if (empty($peticion))
    Redireccion::redirigir(RUTA_ADMINISTRAR);

# inicio { seguridad del sistema }
if (!ControlSesion::sesion_iniciada())
    Redireccion::redirigir(RUTA_LOGIN);

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

if (is_null($repositorio))
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
            (string) $_POST['nombre'],
            (boolean) isset($_POST['vigente']) &&
                $_POST['vigente'] === 'on' ? true : false
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

$titulo = Utiles::obtener_titulo($peticion, $modulo);

include_once 'plantillas/documento_declaracion.inc.phtml';
include_once 'plantillas/navbar_modulos.inc.phtml';
include_once dirname(__DIR__) . '/vista/mantener.inc.phtml';
include_once 'plantillas/documento_pie.inc.phtml';
include_once 'plantillas/documento_javascript.inc.phtml';
include_once dirname(__DIR__) . '/vista/javascript.inc.phtml';
include_once 'plantillas/documento_cierre.inc.phtml';
?>