<?php
include_once 'app/nucleo/DaoBaseComImpl.inc.php';
include_once 'Vendedor.inc.php';

class VendedorDaoComImpl extends DaoBaseComImpl {

    protected $com = 'Pytyvo.Vendedor';
    protected $clase_modelo = 'Vendedor';

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