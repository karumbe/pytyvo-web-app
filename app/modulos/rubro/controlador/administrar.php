<?php
include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/Utiles.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/nucleo/Redireccion.inc.php';
include_once 'app/nucleo/Seguridad.inc.php';
include_once dirname(__DIR__) . '/modelo/RubroDaoFactory.inc.php';

# inicio { declaración e inicialización de variables y constantes }
$entidad = 'Rubro';
$entidad_repositorio = $entidad . 'DaoFactory';
$entidad_buscar = strtolower($entidad) . '_buscar';
$entidad_pagina = strtolower($entidad) . '_pagina';
$titulo = 'Gestión de rubros';

define('MODULO', 'rubro');
define('PUEDE_MODIFICAR',
    Seguridad::puede_modificar($_SESSION['cod_usuario'], MODULO));
define('PUEDE_BORRAR',
    Seguridad::puede_borrar($_SESSION['cod_usuario'], MODULO));
define('RUTA_ADMINISTRAR', RUTA_ADMINISTRAR_RUBRO);
define('RUTA_MANTENER', RUTA_MANTENER_RUBRO);
# fin { declaración e inicialización de variables y constantes }

# inicio { seguridad del sistema }
if (!ControlSesion::sesion_iniciada())
    Redireccion::redirigir(RUTA_LOGIN);

if (!Seguridad::puede_acceder($_SESSION['cod_usuario'], MODULO))
    Redireccion::redirigir(RUTA_403);
# fin { seguridad del sistema }

# inicio { declara o recupera las cookies entidad_buscar y entidad_pagina }
${$entidad_buscar} = '';
${$entidad_pagina} = 1;

if (isset($_POST['buscar']))
    ${$entidad_buscar} = Utiles::alltrim($_POST['buscar']);
else
    if (isset($_COOKIE[$entidad_buscar]))
        ${$entidad_buscar} = $_COOKIE[$entidad_buscar];

if (isset($pagina))
    ${$entidad_pagina} = $pagina;
else
    if (isset($_COOKIE[$entidad_pagina]))
        ${$entidad_pagina} = $_COOKIE[$entidad_pagina];

setcookie($entidad_buscar, ${$entidad_buscar}, time() + (86400 * 30), '/');    // 86400 = 1 día.
setcookie($entidad_pagina, ${$entidad_pagina}, time() + (86400 * 30), '/');    // 86400 = 1 día.

$_COOKIE[$entidad_buscar] = ${$entidad_buscar};
$_COOKIE[$entidad_pagina] = ${$entidad_pagina};

$pagina = (int) ${$entidad_pagina};
# fin { declara o recupera las cookies entidad_buscar y entidad_pagina }

$filas = [];
$repositorio = $entidad_repositorio::crear_dao();

if (!empty(${$entidad_buscar}))
    $expresion = Utiles::preparar_para_buscar(${$entidad_buscar});

if (!is_null($repositorio))
    if (isset($expresion) && !empty($expresion))
        $filas = $repositorio->obtener($expresion);
    else
        $filas = $repositorio->obtener_todos();

# inicio { variables de paginación }
$numero_registros = count($filas);
$por_pagina = 25;
$total = ceil($numero_registros / $por_pagina);

if ($pagina > $total) {
    $pagina = 1;
    $inicio = 0;

    setcookie($entidad_pagina, $pagina, time() + (86400 * 30), '/');    // 86400 = 1 día.
    $_COOKIE[$entidad_pagina] = $pagina;
}

$inicio = ($pagina - 1) * $por_pagina;    // inicio del ciclo for (expr1; expr2; expr3).
$fin = $inicio + $por_pagina;             // fin del ciclo for (expr1; expr2; expr3).

if ($fin > $numero_registros) {
    $fin = $numero_registros;
    $en_pagina = $fin - $por_pagina * ($pagina - 1);
} else {
    $en_pagina = $por_pagina;
}
# fin { variables de paginación }

include_once 'plantillas/documento_declaracion.inc.phtml';
include_once 'plantillas/navbar.inc.phtml';
include_once dirname(__DIR__) . '/vista/administrar.inc.phtml';
include_once 'plantillas/documento_javascript.inc.phtml';
include_once 'plantillas/documento_pie.inc.phtml';
//include_once dirname(__DIR__) . '/vista/buscar_cliente_js.inc.phtml';
include_once 'plantillas/documento_cierre.inc.phtml';
?>