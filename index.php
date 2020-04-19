<?php
#ini_set('session.cookie_lifetime', 7200);    // 7200 segundos = 2 horas.
#ini_set('session.gc_maxlifetime', 7200);    // 7200 segundos = 2 horas.

session_start();

$componentes_url = parse_url($_SERVER['REQUEST_URI']);

$ruta = $componentes_url['path'];

$partes_ruta = explode('/', $ruta);
$partes_ruta = array_filter($partes_ruta);
$partes_ruta = array_slice($partes_ruta, 0);

$ruta_elegida = 'app/modulos/sistema/vista/404.phtml';

if ($partes_ruta[0] == 'pytyvo') {
    if (count($partes_ruta) == 1) {
        $ruta_elegida = 'app/modulos/sistema/controlador/home.php';
    } else if (count($partes_ruta) == 2) {
        switch($partes_ruta[1]) {
            case 'logout':
                $ruta_elegida = 'app/nucleo/logout.php';
                break;
            case 'cliente':
                $ruta_elegida = 'app/modulos/cliente/controlador/cliente.php';
                break;
            case 'administrar-ciudad':
                $ruta_elegida = 'app/modulos/ciudad/controlador/administrar.php';
                break;
            case 'mantener-ciudad':
                $ruta_elegida = 'app/modulos/ciudad/controlador/mantener.php';
                break;
            case 'administrar-depar':
                $ruta_elegida = 'app/modulos/depar/controlador/administrar.php';
                break;
            case 'mantener-depar':
                $ruta_elegida = 'app/modulos/depar/controlador/mantener.php';
                break;
            case 'administrar-estado-ot':
                $ruta_elegida = 'app/modulos/estado_ot/controlador/administrar.php';
                break;
            case 'mantener-estado-ot':
                $ruta_elegida = 'app/modulos/estado_ot/controlador/mantener.php';
                break;
            case 'administrar-familia':
                $ruta_elegida = 'app/modulos/familia/controlador/administrar.php';
                break;
            case 'mantener-familia':
                $ruta_elegida = 'app/modulos/familia/controlador/mantener.php';
                break;
            case 'login':
                $ruta_elegida = 'app/modulos/login/controlador/login.php';
                break;
            case 'administrar-maquina':
                $ruta_elegida = 'app/modulos/maquina/controlador/administrar.php';
                break;
            case 'mantener-maquina':
                $ruta_elegida = 'app/modulos/maquina/controlador/mantener.php';
                break;
            case 'administrar-marca':
                $ruta_elegida = 'app/modulos/marca/controlador/administrar.php';
                break;
            case 'mantener-marca':
                $ruta_elegida = 'app/modulos/marca/controlador/mantener.php';
                break;
            case 'administrar-marca-ot':
                $ruta_elegida = 'app/modulos/marca_ot/controlador/administrar.php';
                break;
            case 'mantener-marca-ot':
                $ruta_elegida = 'app/modulos/marca_ot/controlador/mantener.php';
                break;
            case 'administrar-modelo':
                $ruta_elegida = 'app/modulos/modelo/controlador/administrar.php';
                break;
            case 'mantener-modelo':
                $ruta_elegida = 'app/modulos/modelo/controlador/mantener.php';
                break;
            case 'administrar-moneda':
                $ruta_elegida = 'app/modulos/moneda/controlador/administrar.php';
                break;
            case 'mantener-moneda':
                $ruta_elegida = 'app/modulos/moneda/controlador/mantener.php';
                break;
            case 'administrar-motivo-ser-cliente':
                $ruta_elegida = 'app/modulos/motivo_clie/controlador/administrar.php';
                break;
            case 'mantener-motivo-ser-cliente':
                $ruta_elegida = 'app/modulos/motivo_clie/controlador/mantener.php';
                break;
            case 'administrar-motivo-nota-debito-credito':
                $ruta_elegida = 'app/modulos/motivo_no/controlador/administrar.php';
                break;
            case 'mantener-motivo-nota-debito-credito':
                $ruta_elegida = 'app/modulos/motivo_no/controlador/mantener.php';
                break;
            case 'administrar-pais':
                $ruta_elegida = 'app/modulos/pais/controlador/administrar.php';
                break;
            case 'mantener-pais':
                $ruta_elegida = 'app/modulos/pais/controlador/mantener.php';
                break;
            case 'administrar-rubro':
                $ruta_elegida = 'app/modulos/rubro/controlador/administrar.php';
                break;
            case 'mantener-rubro':
                $ruta_elegida = 'app/modulos/rubro/controlador/mantener.php';
                break;
            case '403':
                $ruta_elegida = 'app/modulos/sistema/vista/403.phtml';
                break;
            case '404':
                $ruta_elegida = 'app/modulos/sistema/vista/404.phtml';
                break;
            case 'error-token-csrf':
                $ruta_elegida = 'app/modulos/sistema/vista/error_token_csrf.phtml';
                break;
            case 'finanzas':
                $ruta_elegida = 'app/modulos/sistema/controlador/finanzas.php';
                break;
            case 'general':
                $ruta_elegida = 'app/modulos/sistema/controlador/general.php';
                break;
            case 'inventario':
                $ruta_elegida = 'app/modulos/sistema/controlador/inventario.php';
                break;
            case 'servicio-tecnico':
                $ruta_elegida = 'app/modulos/sistema/controlador/servicio_tecnico.php';
                break;
            case 'socio-de-negocio':
                $ruta_elegida = 'app/modulos/sistema/controlador/socio_de_negocio.php';
                break;
            case 'administrar-subrubro':
                $ruta_elegida = 'app/modulos/subrubro/controlador/administrar.php';
                break;
            case 'mantener-subrubro':
                $ruta_elegida = 'app/modulos/subrubro/controlador/mantener.php';
                break;
            case 'administrar-unidad-medida':
                $ruta_elegida = 'app/modulos/unidad_medida/controlador/administrar.php';
                break;
            case 'mantener-unidad-medida':
                $ruta_elegida = 'app/modulos/unidad_medida/controlador/mantener.php';
                break;
        }
    } else if (count($partes_ruta) == 3) {
        switch ($partes_ruta[1]) {
            case 'ajax':
                switch ($partes_ruta[2]) {
                    case 'depar-obtener-todos-vigente':
                        $ruta_elegida = 'app/modulos/ajax/depar_obtener_todos_vigente.php';
                        break;
                    case 'maquina-obtener-todos-vigente':
                        $ruta_elegida = 'app/modulos/ajax/maquina_obtener_todos_vigente.php';
                        break;
                    case 'marca-ot-obtener-todos-vigente':
                        $ruta_elegida = 'app/modulos/ajax/marca_ot_obtener_todos_vigente.php';
                        break;
                    case 'motivo-ser-cliente-nombre-existe':
                        $ruta_elegida = 'app/modulos/ajax/motivo_clie_nombre_existe.php';
                        break;
                    case 'motivo-ser-cliente-obtener-todos-vigente':
                        $ruta_elegida = 'app/modulos/ajax/motivo_clie_obtener_todos_vigente.php';
                        break;
                }
                break;
        }
    } else if (count($partes_ruta) == 4) {
        switch ($partes_ruta[1]) {
            case 'cliente':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/cliente/controlador/cliente.php';
                        break;
                    case 'ver':
                        $codigo = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/cliente/controlador/ver_cliente.php';
                        break;
                    case 'cuenta-por-cobrar':
                        $codigo = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/cuenta_por_cobrar/controlador/cuenta_por_cobrar.php';
                        break;
                    case 'estado-de-cuenta':
                        $codigo = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/cuenta_por_cobrar/vista/pdf_estado_cuenta.php';
                        break;
                  }
                break;
            case 'administrar-ciudad':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/ciudad/controlador/administrar.php';
                        break;
                    }
            case 'administrar-depar':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/depar/controlador/administrar.php';
                        break;
                    }
            case 'administrar-estado-ot':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/estado_ot/controlador/administrar.php';
                        break;
                    }
                break;
            case 'administrar-familia':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/familia/controlador/administrar.php';
                        break;
                    }
                break;
            case 'administrar-maquina':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/maquina/controlador/administrar.php';
                        break;
                    }
                break;
            case 'administrar-marca':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/marca/controlador/administrar.php';
                        break;
                    }
                break;
            case 'administrar-marca-ot':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/marca_ot/controlador/administrar.php';
                        break;
                    }
                break;
            case 'administrar-modelo':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/modelo/controlador/administrar.php';
                        break;
                    }
                break;
            case 'administrar-motivo-ser-cliente':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/motivo_clie/controlador/administrar.php';
                        break;
                    }
                break;
            case 'administrar-motivo-nota-debito-credito':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/motivo_no/controlador/administrar.php';
                        break;
                    }
                break;
            case 'administrar-pais':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/pais/controlador/administrar.php';
                        break;
                    }
                break;
            case 'administrar-rubro':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/rubro/controlador/administrar.php';
                        break;
                    }
                break;
            case 'administrar-subrubro':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/subrubro/controlador/administrar.php';
                        break;
                    }
                break;
            case 'administrar-unidad-medida':
                switch ($partes_ruta[2]) {
                    case 'pagina':
                        $pagina = (int) $partes_ruta[3];
                        $ruta_elegida =
                            'app/modulos/unidad_medida/controlador/administrar.php';
                        break;
                    }
                break;
        }
    }
}

include_once $ruta_elegida;
?>
