<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'CuentaPorCobrarDaoComImpl.inc.php';

class CuentaPorCobrarDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'CuentaPorCobrarDaoComImpl';

}
?>