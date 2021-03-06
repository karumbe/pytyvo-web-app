<?php
include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/Utiles.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/nucleo/Redireccion.inc.php';
include_once 'app/nucleo/Seguridad.inc.php';

if (!ControlSesion::sesion_iniciada())
    Redireccion::redirigir(RUTA_LOGIN);

# inicio { establece el acceso a los módulos }
define('PUEDE_ACCEDER_FAMILIA',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'familia'));
define('PUEDE_ACCEDER_RUBRO',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'rubro'));
define('PUEDE_ACCEDER_SUBRUBRO',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'subrubro'));
define('PUEDE_ACCEDER_MARCA',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'marca'));
define('PUEDE_ACCEDER_UNIDAD_MEDIDA',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'unidad'));
# fin { establece el acceso a los módulos }

$titulo = 'Inventario';

include_once 'plantillas/documento_declaracion.inc.phtml';
include_once 'plantillas/navbar.inc.phtml';
include_once dirname(__DIR__) . '/vista/inventario.inc.phtml';
include_once 'plantillas/documento_pie.inc.phtml';
include_once 'plantillas/documento_javascript.inc.phtml';
include_once 'plantillas/documento_cierre.inc.phtml';
?>
