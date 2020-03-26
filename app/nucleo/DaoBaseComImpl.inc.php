<?php
include_once 'Utiles.inc.php';
include_once 'DaoBase.inc.php';

abstract class DaoBaseComImpl extends DaoBase {

    protected $com;
    protected $conexion;
    protected $clase_modelo;

    /**
    * Verifica la integridad referencial de un registro.
    *
    * @param integer $codigo
    * Código a ser verificado.
    *
    * @return boolean
    * true si está relacionado u ocurre un error y false en caso contrario.
    */
    public function esta_relacionado($codigo) {
        # inicio { validación del parámetro }
        if (!$this->validar_param_codigo($codigo)) {
            return true;
        }
        # fin { validación del parámetro }

        $esta_relacionado = true;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $esta_relacionado = $this->conexion->EstaRelacionado($codigo);
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $esta_relacionado;
    }

    /**
    * Verifica si un código existe.
    *
    * @param integer $codigo
    * Código a ser verificado.
    *
    * @return boolean
    * true si existe u ocurre un error y false en caso contrario.
    */
    public function codigo_existe($codigo) {
        # inicio { validación del parámetro }
        if (!$this->validar_param_codigo($codigo)) {
            return true;
        }
        # fin { validación del parámetro }

        $existe = true;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $existe = $this->conexion->CodigoExiste($codigo);
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $existe;
    }

    /**
    * Verifica si un nombre existe.
    *
    * @param string $nombre
    * Nombre a ser verificado.
    *
    * @return boolean
    * true si existe u ocurre un error y false en caso contrario.
    */
    public function nombre_existe($nombre) {
        # inicio { validación del parámetro }
        if (!$this->validar_param_nombre($nombre)) {
            return true;
        }
        # fin { validación del parámetro }

        $existe = true;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $existe = $this->conexion->NombreExiste($nombre);
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $existe;
    }

    /**
    * Realiza una búsqueda por codigo.
    *
    * @param integer $codigo
    * Código a buscar.
    *
    * @return object|null
    * object si tiene éxito y null en caso contrario.
    */
    # @Override
    public function obtener_por_codigo($codigo) {
        # inicio { validación del parámetro }
        if (!$this->validar_param_codigo($codigo)) {
            return null;
        }
        # fin { validación del parámetro }

        $registro = null;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $resultado = $this->conexion->ObtenerPorCodigo($codigo);

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
    * Realiza una búsqueda por nombre.
    *
    * @param string $nombre
    * Nombre a buscar.
    *
    * @return object|null
    * object si tiene éxito y null en caso contrario.
    */
    # @Override
    public function obtener_por_nombre($nombre) {
        # inicio { validación del parámetro }
        if (!$this->validar_param_nombre($nombre)) {
            return null;
        }
        # fin { validación del parámetro }

        $registro = null;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $resultado = $this->conexion->ObtenerPorNombre($nombre);

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
    * Devuelve todos los datos de todos los registros.
    *
    * @param string $condicion_filtrado (opcional)
    * Condición de filtrado de registros.
    *
    * @return array
    * Arreglo con datos si tiene éxito y arreglo vacío en caso contrario.
    */
    # @Override
    public function obtener_todos($condicion_filtrado = null) {
        $registros = [];

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $resultado = $this->conexion->ObtenerTodos();

                if ($xml = simplexml_load_string($resultado)) {
                    foreach ($xml as $fila) {
                        $registro = $this->cargar_datos(new $this->clase_modelo,
                            $fila);

                        if (!is_null($registro))
                            $registros[] = $registro;
                    }
                } else {
                    # print 'No se ha podido cargar la cadena XML.' . '<br>';
                }
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $registros;
    }

    /**
    * Realiza una búsqueda por codigo y nombre.
    *
    * @param string $expresion
    * Expresión a buscar.
    *
    * @param string $condicion_filtrado (opcional)
    * Condición de filtrado de registros.
    *
    * @return array
    * Arreglo con datos si tiene éxito y arreglo vacío en caso contrario.
    */
    # @Override
    public function obtener($expresion, $condicion_filtrado = null) {
        $registros = [];

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $expresion = iconv('UTF-8', 'ISO-8859-1', $expresion);
                $resultado = $this->conexion->Obtener($expresion);

                if ($xml = simplexml_load_string($resultado)) {
                    foreach ($xml as $fila) {
                        $registro = $this->cargar_datos(new $this->clase_modelo,
                            $fila);

                        if (!is_null($registro))
                            $registros[] = $registro;
                    }
                } else {
                    # print 'No se ha podido cargar la cadena XML.' . '<br>';
                }
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $registros;
    }

    /**
    * Agrega un nuevo registro a la base de datos.
    *
    * @param integer $usuario
    * Código del usuario.
    *
    * @param object $dto
    * Objeto a ser agregado.
    *
    * @return boolean
    * true si tiene éxito y false en caso contrario.
    */
    public function agregar($usuario, $dto) {
        $agregado = false;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $agregado = $this->conexion->Agregar($usuario, $dto);
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $agregado;
    }

    /**
    * Modifica un registro de la base de datos.
    *
    * @param integer $usuario
    * Código del usuario.
    *
    * @param object $dto
    * Objeto a ser modificado.
    *
    * @return boolean
    * true si tiene éxito y false en caso contrario.
    */
    public function modificar($usuario, $dto) {
        $modificado = false;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $modificado = $this->conexion->Modificar($usuario, $dto);
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $modificado;
    }

    /**
    * Borra un registro de la base de datos.
    *
    * @param integer $usuario
    * Código del usuario.
    *
    * @param integer $codigo
    * Código a ser borrado.
    *
    * @return boolean
    * true si tiene éxito y false en caso contrario.
    */
    public function borrar($usuario, $codigo) {
        $borrado = false;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $borrado = $this->conexion->Borrar($usuario, $codigo);
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $borrado;
    }

    /**
    * Devuelve un objeto de transferencia de datos (DTO) vacío.
    *
    * El patrón DTO tiene como finalidad de crear un objeto plano (POJO) con una
    * serie de atributos que puedan ser enviados o recuperados del servidor en
    * una sola invocación, de tal forma que un DTO puede contener información de
    * múltiples fuentes o tablas y concentrarlas en una única clase simple.
    * https://www.oscarblancarteblog.com/2018/11/30/data-transfer-object-dto-patron-diseno/
    *
    * @return object|null
    * Objeto de transferencia de datos (DTO) si tiene éxito y null en caso
    * contrario.
    */
    # @Override
    public function obtener_dto() {
        $dto = null;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $dto = $this->conexion->ObtenerDTO();
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $dto;
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
                $b_vigente = (boolean)
                    ($datos->vigente == 'true') ? true : false;

                $modelo->establecer_codigo($i_codigo);
                $modelo->establecer_nombre($s_nombre);
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
    * Conecta al COM (Component Object Model).
    */
    protected function conectar() {
        if (isset($this->com) && !empty($this->com)) {
            try {
                $this->conexion = new COM($this->com, NULL, CP_ACP);
            } catch (Exception $ex) {
                print 'ERROR: ' . $ex->getMessage() . '<br>';
                die();
            }
        }
    }

    /**
    * Desconecta del COM (Component Object Model).
    */
    protected function desconectar() {
        if (isset($this->conexion)) {
            $this->conexion = null;
        }
    }

    /**
    * Verifica si la variable $modelo es del tipo de objeto de la propiedad
    * $clase_modelo.
    *
    * @param object $modelo
    * Variable a ser verificada.
    *
    * @return boolean
    * true si es válida y false en caso contrario.
    */
    protected function validar_modelo($modelo) {
        if (isset($this->clase_modelo) && !empty($this->clase_modelo)) {
            if (isset($modelo) &&
                    gettype($modelo) === 'object' &&
                    get_class($modelo) === $this->clase_modelo) {
                return true;
            }
        }

        return false;
    }

    /**
    * Verifica si la variable $datos es del tipo de objeto SimpleXMLElement.
    *
    * @param object $datos
    * Variable a ser verificada.
    *
    * @return boolean
    * true si es válida y false en caso contrario.
    */
    protected function validar_datos($datos) {
        if (isset($datos) &&
                gettype($datos) === 'object' &&
                get_class($datos) === 'SimpleXMLElement') {
            return true;
        }

        return false;
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
    protected function validar_param_codigo($valor) {
        return Utiles::rango_entero($valor, 1, 9999);
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
    protected function validar_param_nombre($valor) {
        return Utiles::longitud_texto($valor, 6, 30);
    }

}
?>