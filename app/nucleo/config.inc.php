<?php
// Constantes.
define('NOMBRE_EMPRESA', 'A & A Importaciones S.R.L.');
define('NOMBRE_SISTEMA', 'Pytyvõ');

// Rutas de la web.
define('SERVIDOR', 'http://localhost/pytyvo');
#define('SERVIDOR', 'https://comercios.karumbe.com.py/pytyvo');
define('RUTA_403', SERVIDOR . '/403');
define('RUTA_404', SERVIDOR . '/404');
define('RUTA_LOGIN', SERVIDOR . '/login');
define('RUTA_LOGOUT', SERVIDOR . '/logout');
define('RUTA_CLIENTE', SERVIDOR . '/cliente');

# AJAX
define('RUTA_AJAX', SERVIDOR . '/ajax');
define('RUTA_MAQUINA_OBTENER_TODOS_VIGENTE', RUTA_AJAX . '/maquina-obtener-todos-vigente');
define('RUTA_MARCA_OT_OBTENER_TODOS_VIGENTE', RUTA_AJAX . '/marca-ot-obtener-todos-vigente');
define('RUTA_MOTIVO_CLIE_NOMBRE_EXISTE', RUTA_AJAX . '/motivo-ser-cliente-nombre-existe');
define('RUTA_MOTIVO_CLIE_OBTENER_TODOS_VIGENTE', RUTA_AJAX . '/motivo-ser-cliente-obtener-todos-vigente');

# Inicio > Definiciones > Socios de negocios
define('RUTA_SOCIO_NEGOCIO', SERVIDOR . '/socio-de-negocio');
define('RUTA_ADMINISTRAR_PAIS', SERVIDOR . '/administrar-pais');
define('RUTA_MANTENER_PAIS', SERVIDOR . '/mantener-pais');
define('RUTA_ADMINISTRAR_MOTIVO_CLIE', SERVIDOR . '/administrar-motivo-ser-cliente');
define('RUTA_MANTENER_MOTIVO_CLIE', SERVIDOR . '/mantener-motivo-ser-cliente');
define('RUTA_ADMINISTRAR_MOTIVO_NO', SERVIDOR . '/administrar-motivo-nota-debito-credito');
define('RUTA_MANTENER_MOTIVO_NO', SERVIDOR . '/mantener-motivo-nota-debito-credito');

# Inicio > Definiciones > Inventario
define('RUTA_INVENTARIO', SERVIDOR . '/inventario');
define('RUTA_ADMINISTRAR_FAMILIA', SERVIDOR . '/administrar-familia');
define('RUTA_MANTENER_FAMILIA', SERVIDOR . '/mantener-familia');
define('RUTA_ADMINISTRAR_RUBRO', SERVIDOR . '/administrar-rubro');
define('RUTA_MANTENER_RUBRO', SERVIDOR . '/mantener-rubro');
define('RUTA_ADMINISTRAR_SUBRUBRO', SERVIDOR . '/administrar-subrubro');
define('RUTA_MANTENER_SUBRUBRO', SERVIDOR . '/mantener-subrubro');
define('RUTA_ADMINISTRAR_MARCA', SERVIDOR . '/administrar-marca');
define('RUTA_MANTENER_MARCA', SERVIDOR . '/mantener-marca');
define('RUTA_ADMINISTRAR_UNIDAD_MEDIDA', SERVIDOR . '/administrar-unidad-medida');
define('RUTA_MANTENER_UNIDAD_MEDIDA', SERVIDOR . '/mantener-unidad-medida');

# Inicio > Definiciones > Servicio técnico
define('RUTA_SERVICIO_TECNICO', SERVIDOR . '/servicio-tecnico');
define('RUTA_ADMINISTRAR_MAQUINA', SERVIDOR . '/administrar-maquina');
define('RUTA_MANTENER_MAQUINA', SERVIDOR . '/mantener-maquina');
define('RUTA_ADMINISTRAR_MARCA_OT', SERVIDOR . '/administrar-marca-ot');
define('RUTA_MANTENER_MARCA_OT', SERVIDOR . '/mantener-marca-ot');
define('RUTA_ADMINISTRAR_MODELO', SERVIDOR . '/administrar-modelo');
define('RUTA_MANTENER_MODELO', SERVIDOR . '/mantener-modelo');
define('RUTA_ADMINISTRAR_ESTADO_OT', SERVIDOR . '/administrar-estado-ot');
define('RUTA_MANTENER_ESTADO_OT', SERVIDOR . '/mantener-estado-ot');

// Recursos.
define('RUTA_CSS', SERVIDOR . '/css/');
define('RUTA_JS', SERVIDOR . '/js/');

define('RUTA_JQUERY', SERVIDOR . '/static/jquery/');
define('RUTA_POPPER', SERVIDOR . '/static/popper/');
define('RUTA_BOOTSTRAP', SERVIDOR . '/static/bootstrap/');
define('RUTA_FONTAWESOME', SERVIDOR . '/static/fontawesome/');
define('RUTA_FONTS', SERVIDOR . '/static/fonts/');
define('RUTA_SELECT2', SERVIDOR . '/static/select2/');

// Mensajes.
define('ERROR_1229', 'Muy pocos argumentos.');
define('HTTP_401_NO_AUTORIZADO', '401 No autorizado.');
define('HTTP_403_PROHIBIDO', '403 Prohibido - No tiene permiso para acceder al recurso en este servidor.');
define('HTTP_503_SERVICIO_NO_DISPONIBLE', '503 Servicio no disponible.');
?>
