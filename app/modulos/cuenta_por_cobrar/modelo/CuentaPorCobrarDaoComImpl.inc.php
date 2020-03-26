<?php
include_once 'app/nucleo/DaoBaseComImpl.inc.php';
include_once 'CuentaPorCobrar.inc.php';

class CuentaPorCobrarDaoComImpl extends DaoBaseComImpl {

    protected $com = 'Pytyvo.CuentaPorCobrar';
    protected $clase_modelo = 'CuentaPorCobrar';

    /**
    * Realiza una búsqueda por código de cliente.
    *
    * @param integer $codigo
    * Código a buscar.
    *
    * @param string $condicion_filtrado (opcional)
    * Condición de filtrado de registros.
    *
    * @return array
    * Arreglo con datos si tiene éxito y arreglo vacío en caso contrario.
    */
    # @Override
    public function obtener_por_codigo($codigo, $condicion_filtrado = null) {
        # inicio { validaciones de parámetros }
        if (!$this->validar_param_codigo($codigo))
            return array();

        if (!is_null($condicion_filtrado))
            if (is_string($condicion_filtrado))
                $condicion_filtrado =
                    iconv('UTF-8', 'ISO-8859-1', $condicion_filtrado);
            else
                return array();
        # fin { validaciones de parámetros }

        $registros = [];

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $resultado = $this->conexion->ObtenerPorCodigo($codigo,
                    $condicion_filtrado);

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
                $i_tipodocu = (int) $datos->tipodocu;
                $i_nrodocu = (int) $datos->nrodocu;
                $s_nrofact = (string) $datos->nrofact;
                $s_cuota = (string) $datos->cuota;
                $d_fecha_emi = (string) $datos->fecha_emi;
                $d_fecha_vto = (string) $datos->fecha_vto;
                $f_saldo = (float) $datos->saldo;
                $i_dias = (int) $datos->dias;
                $i_cod_moneda = (int) $datos->cod_moneda;
                $s_moneda = (string) $datos->moneda;
                $s_simbolo = (string) $datos->simbolo;
                $b_decimales = (boolean)
                    ($datos->decimales == 'true') ? true : false;
                $i_cod_cliente = (int) $datos->cod_cliente;
                $s_cliente = (string) $datos->cliente;
                $s_ruc = (string) $datos->ruc;
                $s_direccion = (string) $datos->direccion;
                $s_departamen = (string) $datos->departamen;
                $s_ciudad = (string) $datos->ciudad;
                $s_telefono = (string) $datos->telefono;

                $modelo->establecer_tipodocu($i_tipodocu);
                $modelo->establecer_nrodocu($i_nrodocu);
                $modelo->establecer_nrofact($s_nrofact);
                $modelo->establecer_cuota($s_cuota);
                $modelo->establecer_fecha_emi($d_fecha_emi);
                $modelo->establecer_fecha_vto($d_fecha_vto);
                $modelo->establecer_saldo($f_saldo);
                $modelo->establecer_dias($i_dias);
                $modelo->establecer_cod_moneda($i_cod_moneda);
                $modelo->establecer_moneda($s_moneda);
                $modelo->establecer_simbolo($s_simbolo);
                $modelo->establecer_decimales($b_decimales);
                $modelo->establecer_cod_cliente($i_cod_cliente);
                $modelo->establecer_cliente($s_cliente);
                $modelo->establecer_ruc($s_ruc);
                $modelo->establecer_direccion($s_direccion);
                $modelo->establecer_departamen($s_departamen);
                $modelo->establecer_ciudad($s_ciudad);
                $modelo->establecer_telefono($s_telefono);

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

}
?>