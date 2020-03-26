<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'VendedorDaoComImpl.inc.php';

class VendedorDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'VendedorDaoComImpl';

}
?>