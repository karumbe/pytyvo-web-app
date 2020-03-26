<?php
include_once 'app/nucleo/DaoBaseComImpl.inc.php';
include_once 'Ciudad.inc.php';

class CiudadDaoComImpl extends DaoBaseComImpl {

    protected $com = 'Pytyvo.Ciudad';
    protected $clase_modelo = 'Ciudad';

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
                $b_vigente = (boolean)
                    ($datos->vigente == 'true') ? true : false;

                $modelo->establecer_codigo($i_codigo);
                $modelo->establecer_nombre($s_nombre);
                $modelo->establecer_departamen($i_departamen);
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