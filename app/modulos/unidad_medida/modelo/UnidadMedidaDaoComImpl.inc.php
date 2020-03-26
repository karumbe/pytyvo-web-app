<?php
include_once 'app/nucleo/DaoBaseComImpl.inc.php';
include_once 'UnidadMedida.inc.php';

class UnidadMedidaDaoComImpl extends DaoBaseComImpl {

    protected $com = 'Pytyvo.UnidadMedida';
    protected $clase_modelo = 'UnidadMedida';

    /**
    * Verifica si un símbolo existe.
    *
    * @param string $simbolo
    * Símbolo a ser verificado.
    *
    * @return boolean
    * true si existe u ocurre un error y false en caso contrario.
    */
    public function simbolo_existe($simbolo) {
        # inicio { validación del parámetro }
        if (!$this->validar_param_simbolo($simbolo)) {
            return true;
        }
        # fin { validación del parámetro }

        $existe = true;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $existe = $this->conexion->SimboloExiste($simbolo);
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $existe;
    }

    /**
    * Realiza una búsqueda por símbolo.
    *
    * @param string $simbolo
    * Símbolo a buscar.
    *
    * @return object|null
    * object si tiene éxito y null en caso contrario.
    */
    public function obtener_por_simbolo($simbolo) {
        # inicio { validación del parámetro }
        if (!$this->validar_param_simbolo($simbolo)) {
            return null;
        }
        # fin { validación del parámetro }

        $registro = null;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $resultado = $this->conexion->ObtenerPorSimbolo($simbolo);

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
                $s_simbolo = (string) $datos->simbolo;
                $b_divisible = (boolean)
                    ($datos->divisible == 'true') ? true : false;
                $b_vigente = (boolean)
                    ($datos->vigente == 'true') ? true : false;

                $modelo->establecer_codigo($i_codigo);
                $modelo->establecer_nombre($s_nombre);
                $modelo->establecer_simbolo($s_simbolo);
                $modelo->establecer_divisible($b_divisible);
                $modelo->establecer_vigente($b_vigente);

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
    protected function validar_param_simbolo($valor) {
        return Utiles::longitud_texto($valor, 1, 5);
    }

}
?>