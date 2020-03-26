<?php
include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/Utiles.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/nucleo/Redireccion.inc.php';
include_once 'app/modulos/depar/modelo/Depar.inc.php';
include_once 'app/modulos/depar/modelo/DeparDaoFactory.inc.php';
include_once 'app/modulos/ciudad/modelo/Ciudad.inc.php';
include_once 'app/modulos/ciudad/modelo/CiudadDaoFactory.inc.php';
include_once 'app/modulos/barrio/modelo/Barrio.inc.php';
include_once 'app/modulos/barrio/modelo/BarrioDaoFactory.inc.php';
include_once 'app/modulos/ruta/modelo/Ruta.inc.php';
include_once 'app/modulos/ruta/modelo/RutaDaoFactory.inc.php';
include_once 'app/modulos/plazo/modelo/Plazo.inc.php';
include_once 'app/modulos/plazo/modelo/PlazoDaoFactory.inc.php';
include_once 'app/modulos/vendedor/modelo/Vendedor.inc.php';
include_once 'app/modulos/vendedor/modelo/VendedorDaoFactory.inc.php';
include_once 'app/modulos/motivo_clie/modelo/MotivoClie.inc.php';
include_once 'app/modulos/motivo_clie/modelo/MotivoClieDaoFactory.inc.php';
include_once dirname(__DIR__) . '/modelo/ClienteDaoFactory.inc.php';

if (!ControlSesion::sesion_iniciada())
    Redireccion::redirigir(RUTA_LOGIN);

if (!Utiles::variable_iniciada($codigo))
    Redireccion::redirigir(RUTA_404);



# inicio { repositorio: cliente }
$repositorio = ClienteDaoFactory::crear_dao();
$cliente = null;

if (!is_null($repositorio))
    $cliente = $repositorio->obtener_por_codigo($codigo);

if (is_null($cliente))
    Redireccion::redirigir(RUTA_404);
# fin { repositorio: cliente }



# inicio { repositorio: departamento }
$repositorio_depar = DeparDaoFactory::crear_dao();
$depar = null;

if (!is_null($repositorio_depar))
    $depar = $repositorio_depar->obtener_por_codigo(
        $cliente->obtener_departamen());

if (is_null($depar))
    $depar = new Depar();
# fin { repositorio: departamento }



# inicio { repositorio: ciudad }
$repositorio_ciudad = CiudadDaoFactory::crear_dao();
$ciudad = null;

if (!is_null($repositorio_ciudad))
    $ciudad = $repositorio_ciudad->obtener_por_codigo(
        $cliente->obtener_ciudad());

if (is_null($ciudad))
    $ciudad = new Ciudad();
# fin { repositorio: ciudad }



# inicio { repositorio: barrio }
$repositorio_barrio = BarrioDaoFactory::crear_dao();
$barrio = null;

if (!is_null($repositorio_barrio))
    $barrio = $repositorio_barrio->obtener_por_codigo(
        $cliente->obtener_barrio());

if (is_null($barrio))
    $barrio = new Barrio();
# fin { repositorio: barrio }



# inicio { repositorio: ruta }
$repositorio_ruta = RutaDaoFactory::crear_dao();
$ruta = null;

if (!is_null($repositorio_ruta))
    $ruta = $repositorio_ruta->obtener_por_codigo(
        $cliente->obtener_ruta());

if (is_null($ruta))
    $ruta = new Ruta();
# fin { repositorio: ruta }



# inicio { repositorio: plazo }
$repositorio_plazo = PlazoDaoFactory::crear_dao();
$plazo = null;

if (!is_null($repositorio_plazo))
    $plazo = $repositorio_plazo->obtener_por_codigo(
        $cliente->obtener_plazo());

if (is_null($plazo))
    $plazo = new Plazo();
# fin { repositorio: plazo }



# inicio { repositorio: vendedor }
$repositorio_vendedor = VendedorDaoFactory::crear_dao();
$vendedor = null;

if (!is_null($repositorio_vendedor))
    $vendedor = $repositorio_vendedor->obtener_por_codigo(
        $cliente->obtener_vendedor());

if (is_null($vendedor))
    $vendedor = new Vendedor();
# fin { repositorio: vendedor }



# inicio { repositorio: motivo_clie }
$repositorio_motivo_clie = MotivoClieDaoFactory::crear_dao();
$motivo_clie = null;

if (!is_null($repositorio_motivo_clie))
    $motivo_clie = $repositorio_motivo_clie->obtener_por_codigo(
        $cliente->obtener_motivoclie());

if (is_null($motivo_clie))
    $motivo_clie = new MotivoClie();
# fin { repositorio: motivo_clie }



$titulo = 'Información del cliente | ' . Utiles::upper(NOMBRE_SISTEMA);

include_once 'plantillas/documento_declaracion.inc.phtml';
include_once 'plantillas/navbar_modulos.inc.phtml';
include_once dirname(__DIR__) . '/vista/ver_cliente.inc.phtml';
include_once 'plantillas/documento_pie_modulos.inc.phtml';
include_once 'plantillas/documento_javascript.inc.phtml';
//include_once dirname(__DIR__) . '/vista/ver_cliente_js.inc.phtml';
include_once 'plantillas/documento_cierre.inc.phtml';
?>