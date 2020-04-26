<?php
include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/Utiles.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/nucleo/Redireccion.inc.php';
include_once 'app/nucleo/Seguridad.inc.php';

if (!ControlSesion::sesion_iniciada())
    Redireccion::redirigir(RUTA_LOGIN);

# inicio { establece el acceso a los módulos }

# Inicio > Definiciones > General
define('PUEDE_ACCEDER_DEPAR',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'depar'));
define('PUEDE_ACCEDER_CIUDAD',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'ciudad'));
define('PUEDE_ACCEDER_BARRIO',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'barrio'));
# Inicio > Definiciones > General

# Inicio > Definiciones > Finanzas
define('PUEDE_ACCEDER_MONEDA',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'moneda'));
# Inicio > Definiciones > Finanzas

# Inicio > Definiciones > Socios de negocios
define('PUEDE_ACCEDER_PAIS',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'pais'));
define('PUEDE_ACCEDER_MOTIVO_CLIE',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'motivo_clie'));
define('PUEDE_ACCEDER_MOTIVO_NO',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'motivo_no'));
# Inicio > Definiciones > Socios de negocios

# Inicio > Definiciones > Inventario
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
# Inicio > Definiciones > Inventario

# Inicio > Definiciones > Servicio técnico
define('PUEDE_ACCEDER_MAQUINA',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'maquina'));
define('PUEDE_ACCEDER_MARCA_OT',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'marca_ot'));
define('PUEDE_ACCEDER_MODELO',
    Seguridad::puede_acceder($_SESSION['cod_usuario'], 'modelo'));
# Inicio > Definiciones > Servicio técnico

# fin { establece el acceso a los módulos }

$titulo = 'Bienvenido';

include_once 'plantillas/documento_declaracion.inc.phtml';
include_once 'plantillas/navbar.inc.phtml';
include_once dirname(__DIR__) . '/vista/home.inc.phtml';
include_once 'plantillas/documento_pie.inc.phtml';
include_once 'plantillas/documento_javascript.inc.phtml';
include_once 'plantillas/documento_cierre.inc.phtml';
?>
