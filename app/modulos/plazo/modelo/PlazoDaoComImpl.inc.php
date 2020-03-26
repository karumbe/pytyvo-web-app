<?php
include_once 'app/nucleo/DaoBaseComImpl.inc.php';
include_once 'Plazo.inc.php';

class PlazoDaoComImpl extends DaoBaseComImpl {

    protected $com = 'Pytyvo.Plazo';
    protected $clase_modelo = 'Plazo';

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
                $i_num_vtos = (int) $datos->num_vtos;
                $s_separacion = (string) $datos->separacion;
                $i_primero = (int) $datos->primero;
                $i_resto = (int) $datos->resto;
                $b_vigente = false;

                $modelo->establecer_codigo($i_codigo);
                $modelo->establecer_nombre($s_nombre);
                $modelo->establecer_num_vtos($i_num_vtos);
                $modelo->establecer_separacion($s_separacion);
                $modelo->establecer_primero($i_primero);
                $modelo->establecer_resto($i_resto);
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