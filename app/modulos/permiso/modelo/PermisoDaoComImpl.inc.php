<?php
include_once 'app/nucleo/DaoBaseComImpl.inc.php';
include_once 'Permiso.inc.php';

class PermisoDaoComImpl extends DaoBaseComImpl {

    protected $com = 'Pytyvo.Permiso';
    protected $clase_modelo = 'Permiso';

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
    public function puede_acceder($usuario, $modulo) {
        # inicio { validación de parámetros }
        if (!$this->validar_param_codigo($usuario))
            return false;

        if (!$this->validar_param_modulo($modulo))
            return false;
        # fin { validación de parámetros }

        $acceder = false;

        try {
            $this->conectar();

            if (isset($this->conexion))
                $acceder = $this->conexion->PuedeAcceder($usuario, $modulo);
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

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
    public function puede_agregar($usuario, $modulo) {
        # inicio { validación de parámetros }
        if (!$this->validar_param_codigo($usuario))
            return false;

        if (!$this->validar_param_modulo($modulo))
            return false;
        # fin { validación de parámetros }

        $agregar = false;

        try {
            $this->conectar();

            if (isset($this->conexion))
                $agregar = $this->conexion->PuedeAgregar($usuario, $modulo);
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

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
    public function puede_modificar($usuario, $modulo) {
        # inicio { validación de parámetros }
        if (!$this->validar_param_codigo($usuario))
            return false;

        if (!$this->validar_param_modulo($modulo))
            return false;
        # fin { validación de parámetros }

        $modificar = false;

        try {
            $this->conectar();

            if (isset($this->conexion))
                $modificar = $this->conexion->PuedeModificar($usuario, $modulo);
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

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
    public function puede_borrar($usuario, $modulo) {
        # inicio { validación de parámetros }
        if (!$this->validar_param_codigo($usuario))
            return false;

        if (!$this->validar_param_modulo($modulo))
            return false;
        # fin { validación de parámetros }

        $borrar = false;

        try {
            $this->conectar();

            if (isset($this->conexion))
                $borrar = $this->conexion->PuedeBorrar($usuario, $modulo);
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $borrar;
    }

    /**
    * Determina si una variable es de tipo texto y se encuentra dentro de
    * cierta longitud.
    *
    * @param string $valor
    * La variable a ser evaluada.
    *
    * @return boolean
    * Devuelve true si la variable es válida y false en caso contrario.
    */
    protected function validar_param_modulo($valor) {
        return Utiles::longitud_texto($valor, 5, 12);
    }

}
?>
