<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'MaquinaDaoComImpl.inc.php';

class MaquinaDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'MaquinaDaoComImpl';

}
?>