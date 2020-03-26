<?php
include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/Utiles.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/nucleo/Redireccion.inc.php';
include_once 'app/modulos/cliente/modelo/ClienteDaoFactory.inc.php';
include_once dirname(__DIR__) . '/modelo/CuentaPorCobrarDaoFactory.inc.php';

if (!ControlSesion::sesion_iniciada())
    Redireccion::redirigir(RUTA_LOGIN);

if (!Utiles::variable_iniciada($codigo))
    Redireccion::redirigir(RUTA_404);



# inicio { repositorio: cliente }
$repositorio_cliente = ClienteDaoFactory::crear_dao();

if (is_null($repositorio_cliente) ||
        !$repositorio_cliente->codigo_existe($codigo))
    Redireccion::redirigir(RUTA_404);
# fin { repositorio: cliente }



# inicio { repositorio: cuenta_por_cobrar }
$repositorio_cuenta_por_cobrar = CuentaPorCobrarDaoFactory::crear_dao();
$cuenta_por_cobrar = array();

if (!is_null($repositorio_cuenta_por_cobrar))
    $cuenta_por_cobrar = $repositorio_cuenta_por_cobrar->obtener_por_codigo(
        $codigo);

if (!count($cuenta_por_cobrar))
    Redireccion::redirigir(RUTA_404);
# fin { repositorio: cuenta_por_cobrar }



# inicio { calcula los totales por moneda }
$totales = array();

foreach ($cuenta_por_cobrar as $fila) {
    $cod_moneda = $fila->obtener_cod_moneda();    // índice del arreglo.
    $fecha_vto = new DateTime($fila->obtener_fecha_vto());
    $fecha_actual = new DateTime('now');
    $fecha_ultimo_dia = new DateTime($fecha_actual->format('Y-m-t'));

    // Si no existe el código de la moneda en el arreglo, entonces lo creamos.
    if (!isset($totales[$cod_moneda]))
        $totales[$cod_moneda] = array(
            'cod_moneda' => $fila->obtener_cod_moneda(),
            'moneda' => $fila->obtener_moneda(),
            'simbolo' => $fila->obtener_simbolo(),
            'decimales' => $fila->obtener_decimales() ? 2 : 0,
            'vencidos' => 0,
            'a_vencer' => 0,
            'venc_del_mes' => 0,
            'total' => 0
        );

    if ($fila->obtener_dias() <= 0)
        $totales[$cod_moneda]['vencidos'] =
            $totales[$cod_moneda]['vencidos'] + $fila->obtener_saldo();

    if ($fila->obtener_dias() > 0)
        $totales[$cod_moneda]['a_vencer'] =
            $totales[$cod_moneda]['a_vencer'] + $fila->obtener_saldo();

    if ($fecha_vto <= $fecha_ultimo_dia)
        $totales[$cod_moneda]['venc_del_mes'] =
            $totales[$cod_moneda]['venc_del_mes'] + $fila->obtener_saldo();

    $totales[$cod_moneda]['total'] =
        $totales[$cod_moneda]['total'] + $fila->obtener_saldo();
}
# fin { calcula los totales por moneda }



$titulo = 'Estado de Cuenta | ' . Utiles::upper(NOMBRE_SISTEMA);

include_once 'plantillas/documento_declaracion.inc.phtml';
include_once 'plantillas/navbar_modulos.inc.phtml';
include_once dirname(__DIR__) . '/vista/cuenta_por_cobrar.inc.phtml';
include_once 'plantillas/documento_pie_modulos.inc.phtml';
include_once 'plantillas/documento_javascript.inc.phtml';
include_once 'plantillas/documento_cierre.inc.phtml';
?>