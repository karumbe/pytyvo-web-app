<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'ModeloDaoComImpl.inc.php';

class ModeloDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'ModeloDaoComImpl';

}
?>
