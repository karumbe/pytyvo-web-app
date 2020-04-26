<?php
include_once 'app/nucleo/DaoBaseComImpl.inc.php';
include_once 'Barrio.inc.php';

class BarrioDaoComImpl extends DaoBaseComImpl {

    protected $com = 'Pytyvo.Barrio';
    protected $clase_modelo = 'Barrio';

    /**
    * Verifica si un nombre existe.
    *
    * @param string $nombre
    * Nombre a ser verificado.
    *
    * @param integer $departamen
    * Código de departamento a ser verificado.
    *
    * @param integer $ciudad
    * Código de ciudad a ser verificado.
    *
    * @return boolean
    * true si existe u ocurre un error y false en caso contrario.
    */
    # @Override
    public function nombre_existe($nombre, $departamen = 0, $ciudad = 0) {
        # inicio { validaciones de parámetros }
        if (!$this->validar_param_nombre($nombre)) {
            return true;
        }

        if (!$this->validar_param_departamen($departamen)) {
            return true;
        }

        if (!$this->validar_param_ciudad($ciudad)) {
            return true;
        }
        # fin { validaciones de parámetros }

        $existe = true;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $existe = $this->conexion->NombreExiste($nombre,
                    $departamen, $ciudad);
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $existe;
    }

    /**
    * Realiza una búsqueda por nombre.
    *
    * @param string $nombre
    * Nombre a buscar.
    *
    * @param integer $departamen
    * Código de departamento a buscar.
    *
    * @param integer $ciudad
    * Código de ciudad a buscar.
    *
    * @return object|null
    * object si tiene éxito y null en caso contrario.
    */
    # @Override
    public function obtener_por_nombre($nombre, $departamen = 0, $ciudad = 0) {
        # inicio { validaciones de parámetros }
        if (!$this->validar_param_nombre($nombre)) {
            return null;
        }

        if (!$this->validar_param_departamen($departamen)) {
            return null;
        }

        if (!$this->validar_param_ciudad($ciudad)) {
            return null;
        }
        # fin { validaciones de parámetros }

        $registro = null;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $resultado = $this->conexion->ObtenerPorNombre($nombre,
                    $departamen, $ciudad);

                if ($xml = simplexml_load_string($resultado)) {
                    foreach ($xml as $fila) {
                        $registro = $this->cargar_datos(new $this->clase_modelo,
                            $fila);
                        break;
                    }
                } else {
                    # print 'No se ha podido cargar la cadena XML.' . '<br>';
                }
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $registro;
    }

    /**
    * Carga los datos de un objeto del tipo SimpleXMLElement a otro objeto
    * del tipo especificado en el parámetro $modelo.
    *
    * @param object $modelo
    * Modelo en el que se cargarán los datos.
    *
    * @param SimpleXMLElement object $datos.
    * Objeto que contiene los datos.
    *
    * @return object|null
    * object si tiene éxito y null en caso contrario.
    */
    # @Override
    protected function cargar_datos($modelo, $datos) {
        if ($this->validar_modelo($modelo) && $this->validar_datos($datos)) {
            try {
                $i_codigo = (int) $datos->codigo;
                $s_nombre = (string) $datos->nombre;
                $i_departamen = (int) $datos->departamen;
                $i_ciudad = (int) $datos->ciudad;
                $b_vigente = (boolean)
                    ($datos->vigente == 'true') ? true : false;
                $s_nombre_completo = (string) $datos->nombre_completo;

                $modelo->establecer_codigo($i_codigo);
                $modelo->establecer_nombre($s_nombre);
                $modelo->establecer_departamen($i_departamen);
                $modelo->establecer_ciudad($i_ciudad);
                $modelo->establecer_vigente($b_vigente);
                $modelo->establecer_nombre_completo($s_nombre_completo);

                return $modelo;
            } catch (Exception $ex) {
                print 'ERROR: ' . $ex->getMessage() . '<br>';
                die();
            }
        }

        return null;
    }

    /**
    * Determina si una variable es de tipo entero y se encuentra dentro de
    * cierto rango.
    *
    * @param integer $valor
    * La variable a ser evaluada.
    *
    * @return boolean
    * Devuelve true si la variable es válida y false en caso contrario.
    */
    # @Override
    protected function validar_param_codigo($valor) {
        return Utiles::rango_entero($valor, 1, 99999);
    }

    /**
    * Determina si una variable es de tipo entero y se encuentra dentro de
    * cierto rango.
    *
    * @param integer $valor
    * La variable a ser evaluada.
    *
    * @return boolean
    * Devuelve true si la variable es válida y false en caso contrario.
    */
    protected function validar_param_departamen($valor) {
        return Utiles::rango_entero($valor, 1, 999);
    }

    /**
    * Determina si una variable es de tipo entero y se encuentra dentro de
    * cierto rango.
    *
    * @param integer $valor
    * La variable a ser evaluada.
    *
    * @return boolean
    * Devuelve true si la variable es válida y false en caso contrario.
    */
    protected function validar_param_ciudad($valor) {
        return Utiles::rango_entero($valor, 1, 99999);
    }

}
?>
