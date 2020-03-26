<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'RutaDaoComImpl.inc.php';

class RutaDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'RutaDaoComImpl';

}
?>