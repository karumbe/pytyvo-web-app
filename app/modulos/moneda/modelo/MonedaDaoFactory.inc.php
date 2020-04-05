<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'MonedaDaoComImpl.inc.php';

class MonedaDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'MonedaDaoComImpl';

}
?>
