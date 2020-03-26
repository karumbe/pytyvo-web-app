<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'PlazoDaoComImpl.inc.php';

class PlazoDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'PlazoDaoComImpl';

}
?>