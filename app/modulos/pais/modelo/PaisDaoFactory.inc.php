<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'PaisDaoComImpl.inc.php';

class PaisDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'PaisDaoComImpl';

}
?>
