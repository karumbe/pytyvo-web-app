<?php
include_once 'app/nucleo/DaoBaseComImpl.inc.php';
include_once 'Depar.inc.php';

class DeparDaoComImpl extends DaoBaseComImpl {

    protected $com = 'Pytyvo.Depar';
    protected $clase_modelo = 'Depar';

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
        return Utiles::rango_entero($valor, 1, 999);
    }

}
?>