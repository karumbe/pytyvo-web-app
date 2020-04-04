<?php
include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/Utiles.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/nucleo/Redireccion.inc.php';
include_once 'app/nucleo/Seguridad.inc.php';

if (!ControlSesion::sesion_iniciada())
    Redireccion::redirigir(RUTA_LOGIN);

# inicio { establece el acceso a los módulos }
define('PUEDE_ACCEDER_PAIS',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'pais'));
define('PUEDE_ACCEDER_MOTIVO_CLIE',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'motivo_clie'));
define('PUEDE_ACCEDER_MOTIVO_NO',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'motivo_no'));
# fin { establece el acceso a los módulos }

$titulo = 'Socios de negocios';

include_once 'plantillas/documento_declaracion.inc.phtml';
include_once 'plantillas/navbar.inc.phtml';
include_once dirname(__DIR__) . '/vista/socio_de_negocio.inc.phtml';
include_once 'plantillas/documento_pie.inc.phtml';
include_once 'plantillas/documento_javascript.inc.phtml';
include_once 'plantillas/documento_cierre.inc.phtml';
?>
