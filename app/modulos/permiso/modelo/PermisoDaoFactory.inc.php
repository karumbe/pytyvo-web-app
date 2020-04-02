<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'PermisoDaoComImpl.inc.php';

class PermisoDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'PermisoDaoComImpl';

}
?>
