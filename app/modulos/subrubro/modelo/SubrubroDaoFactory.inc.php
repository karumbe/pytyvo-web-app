<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'SubrubroDaoComImpl.inc.php';

class SubrubroDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'SubrubroDaoComImpl';

}
?>