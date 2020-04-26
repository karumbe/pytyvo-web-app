<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'BarrioDaoComImpl.inc.php';

class BarrioDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'BarrioDaoComImpl';

}
?>
