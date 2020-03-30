<?php
include_once 'app/nucleo/DaoBaseComImpl.inc.php';
include_once 'Modelo.inc.php';

class ModeloDaoComImpl extends DaoBaseComImpl {

    protected $com = 'Pytyvo.Modelo';
    protected $clase_modelo = 'Modelo';

    /**
    * Verifica si un nombre existe.
    *
    * @param string $nombre
    * Nombre a ser verificado.
    *
    * @param integer $maquina
    * Código de máquina a ser verificado.
    *
    * @param integer $marca
    * Código de marca a ser verificado.
    *
    * @return boolean
    * true si existe u ocurre un error y false en caso contrario.
    */
    # @Override
    public function nombre_existe($nombre, $maquina = 0, $marca = 0) {
        # inicio { validaciones de parámetros }
        if (!$this->validar_param_nombre($nombre)) {
            return true;
        }

        if (!$this->validar_param_maquina($maquina)) {
            return true;
        }

        if (!$this->validar_param_marca($marca)) {
            return true;
        }
        # fin { validaciones de parámetros }

        $existe = true;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $existe = $this->conexion->NombreExiste($nombre,
                    $maquina, $marca);
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
    * @param integer $maquina
    * Código de máquina a buscar.
    *
    * @param integer $marca
    * Código de marca a buscar.
    *
    * @return object|null
    * object si tiene éxito y null en caso contrario.
    */
    # @Override
    public function obtener_por_nombre($nombre, $maquina = 0, $marca = 0) {
        # inicio { validaciones de parámetros }
        if (!$this->validar_param_nombre($nombre)) {
            return null;
        }

        if (!$this->validar_param_maquina($maquina)) {
            return null;
        }

        if (!$this->validar_param_marca($marca)) {
            return null;
        }
        # fin { validaciones de parámetros }

        $registro = null;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $resultado = $this->conexion->ObtenerPorNombre($nombre,
                    $maquina, $marca);

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
                $i_maquina = (int) $datos->maquina;
                $i_marca = (int) $datos->marca;
                $b_vigente = (boolean)
                    ($datos->vigente == 'true') ? true : false;
                $s_nombre_completo = (string) $datos->nombre_completo;

                $modelo->establecer_codigo($i_codigo);
                $modelo->establecer_nombre($s_nombre);
                $modelo->establecer_maquina($i_maquina);
                $modelo->establecer_marca($i_marca);
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
    * Determina si una variable es de tipo texto y se encuentra dentro de
    * cierta longitud.
    *
    * @param string $valor
    * La variable a ser evaluada.
    *
    * @return boolean
    * Devuelve true si la variable es válida y false en caso contrario.
    */
    # @Override
    protected function validar_param_nombre($valor) {
        return Utiles::longitud_texto($valor, 3, 30);
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
    protected function validar_param_maquina($valor) {
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
    protected function validar_param_marca($valor) {
        return Utiles::rango_entero($valor, 1, 9999);
    }

}
?>
