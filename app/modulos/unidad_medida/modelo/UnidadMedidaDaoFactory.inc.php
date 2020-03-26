<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'UnidadMedidaDaoComImpl.inc.php';

class UnidadMedidaDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'UnidadMedidaDaoComImpl';

}
?>