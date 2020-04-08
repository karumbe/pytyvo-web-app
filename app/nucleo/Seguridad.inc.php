<?php
require_once 'app/lib/hash_equals.inc.php';
require_once 'app/lib/random.inc.php';
include_once 'app/modulos/permiso/modelo/PermisoDaoFactory.inc.php';

class Seguridad {

    /**
    * Verifica si un usuario puede acceder a un módulo.
    *
    * @param integer $usuario
    * Código del usuario.
    *
    * @param string $modulo
    * Nombre del módulo.
    *
    * @return boolean
    * true si tiene permiso para acceder al módulo y false en caso contrario.
    */
    public static function puede_acceder($usuario, $modulo) {
        $acceder = false;
        $repositorio = PermisoDaoFactory::crear_dao();

        if (!is_null($repositorio))
            $acceder = $repositorio->puede_acceder($usuario, $modulo);

        return $acceder;
    }

    /**
    * Verifica si un usuario puede agregar registros.
    *
    * @param integer $usuario
    * Código del usuario.
    *
    * @param string $modulo
    * Nombre del módulo.
    *
    * @return boolean
    * true si tiene permiso para agregar registros y false en caso contrario.
    */
    public static function puede_agregar($usuario, $modulo) {
        $agregar = false;
        $repositorio = PermisoDaoFactory::crear_dao();

        if (!is_null($repositorio))
            $agregar = $repositorio->puede_agregar($usuario, $modulo);

        return $agregar;
    }

    /**
    * Verifica si un usuario puede modificar registros.
    *
    * @param integer $usuario
    * Código del usuario.
    *
    * @param string $modulo
    * Nombre del módulo.
    *
    * @return boolean
    * true si tiene permiso para modificar registros y false en caso contrario.
    */
    public static function puede_modificar($usuario, $modulo) {
        $modificar = false;
        $repositorio = PermisoDaoFactory::crear_dao();

        if (!is_null($repositorio))
            $modificar = $repositorio->puede_modificar($usuario, $modulo);

        return $modificar;
    }

    /**
    * Verifica si un usuario puede borrar registros.
    *
    * @param integer $usuario
    * Código del usuario.
    *
    * @param string $modulo
    * Nombre del módulo.
    *
    * @return boolean
    * true si tiene permiso para borrar registros y false en caso contrario.
    */
    public static function puede_borrar($usuario, $modulo) {
        $borrar = false;
        $repositorio = PermisoDaoFactory::crear_dao();

        if (!is_null($repositorio))
            $borrar = $repositorio->puede_borrar($usuario, $modulo);

        return $borrar;
    }

    /**
    * Crea un token y lo almacena en la sesión actual.
    *
    * @return void
    */
    public static function token_csrf() {
        if (isset($_SESSION['token_csrf']))
            unset($_SESSION['token_csrf']);

        $_SESSION['token_csrf'] = random_token();

        echo '<input type="hidden" name="_token" value="' .
            $_SESSION['token_csrf'] . '">';
    }

    /**
    * Verifica si el token recibido por el método POST es válido.
    *
    * @return boolean
    * true si es válido y false en caso contrario.
    */
    public static function validar_token_csrf() {
        if (isset($_SESSION['token_csrf']) && isset($_POST['_token']))
            if (hash_equals($_SESSION['token_csrf'], $_POST['_token']))
                return true;

        return false;
    }

}
?>
