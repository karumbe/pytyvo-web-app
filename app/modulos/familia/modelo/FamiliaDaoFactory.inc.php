<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'FamiliaDaoComImpl.inc.php';

class FamiliaDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'FamiliaDaoComImpl';

}
?>
