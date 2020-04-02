<?php
include_once 'app/nucleo/DaoBaseComImpl.inc.php';
include_once 'Familia.inc.php';

class FamiliaDaoComImpl extends DaoBaseComImpl {

    protected $com = 'Pytyvo.Familia';
    protected $clase_modelo = 'Familia';

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
                $f_p1 = (float) $datos->p1;
                $f_p2 = (float) $datos->p2;
                $f_p3 = (float) $datos->p3;
                $f_p4 = (float) $datos->p4;
                $f_p5 = (float) $datos->p5;
                $b_vigente = (boolean)
                    ($datos->vigente == 'true') ? true : false;

                $modelo->establecer_codigo($i_codigo);
                $modelo->establecer_nombre($s_nombre);
                $modelo->establecer_p1($f_p1);
                $modelo->establecer_p2($f_p2);
                $modelo->establecer_p3($f_p3);
                $modelo->establecer_p4($f_p4);
                $modelo->establecer_p5($f_p5);
                $modelo->establecer_vigente($b_vigente);

                return $modelo;
            } catch (Exception $ex) {
                print 'ERROR: ' . $ex->getMessage() . '<br>';
                die();
            }
        }

        return null;
    }

}
?>
